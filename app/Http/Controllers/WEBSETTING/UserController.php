<?php

namespace App\Http\Controllers\WEBSETTING;

use App\DataTables\WEBSETTING\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data['menus']   = $this->getDashboardMenu();
        $data['roles']   = Role::all();
        return view('WEBSETTING.user', $data);
    }

    public function datatables(Request $request, UserDataTable $userDataTable)
    {
        $s_username = $request->input('columns.3.search.value');
        $s_firstname = $request->input('columns.4.search.value');
        $s_lastname = $request->input('columns.5.search.value');
        $s_email = $request->input('columns.6.search.value');
        $s_roles = $request->input('columns.7.search.value');

        $query      = User::with('roles')
        ->select('users.id', 'username', 'first_name', 'last_name', 'email', 'foto')
        ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->when($s_firstname, function ($query, $s_firstname) {
            return $query->whereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($s_firstname) . '%']);
        })
        ->when($s_lastname, function ($query, $s_lastname) {
            return $query->whereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($s_lastname) . '%']);
        })
        ->when($s_email, function ($query, $s_email) {
            return $query->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($s_email) . '%']);
        })
        ->when($s_roles, function ($query, $s_roles) {
            return $query->whereHas('roles', function ($query) use ($s_roles) {
                $query->where('name', $s_roles);
            });
        })
        ->orderBy('roles.name', 'asc')
        ->get();
        return $userDataTable->dataTable($query)->toJson();
    }

    public function store(Request $request)
    {
        $attributes = $request->only(['username', 'firstname', 'lastname', 'email', 'roles', 'foto']);

        $rules = [
            'username' => 'required|unique:users,username',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah ada.',
            'firstname.required' => 'Nama depan harus diisi.',
            'lastname.required' => 'Nama belakang harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah ada.',
            'roles.required' => 'Role harus diisi.',
            'foto.required' => 'Foto harus diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berupa gambar.',
            'foto.max' => 'Foto maksimal 2MB.',
        ];
        $this->validators($attributes, $rules, $messages);

        $roles = $request->input('roles');

        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => bcrypt('123sandiku'),
            ]);
    
            $user->assignRole($roles);
    
            $foto = $request->file('foto');
            $foto_name = $user->id . '.' . $foto->getClientOriginalExtension();
    
            // Resize the image to 256x256
            $resizedImage = Image::make($foto)->fit(256, 256);
            $resizedImage->save(public_path('assets/images/user') . '/' . $foto_name);
    
            $user->foto = $foto_name;
            $user->save();
    
            DB::commit();
            $response = responseSuccess('User berhasil ditambahkan.');
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            DB::rollback();
            $response = responseFail('User gagal ditambahkan.', $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $rules = [
            'id' => 'required|exists:users',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists' => trans('messages.exists'),
        ];

        $this->validators($attributes, $rules, $messages);
        $user = User::find($id);
        $data = $this->findDataWhere(User::class, ['id' => $id]);
        $data->roles = $user->getRoleNames();
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {
        $attributes = $request->only(['username', 'firstname', 'lastname', 'email', 'roles', 'foto']);
        // jika foto berisi null, undefined, atau kosong maka hapus kolom foto
        if ($attributes['foto'] == 'null' || $attributes['foto'] == 'undefined' || $attributes['foto'] == '') {
            unset($attributes['foto']);
        }

        $rules = [
            'username' => 'required|unique:users,username,' . $id,
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
            // jika foto kosong maka tidak perlu validasi
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $messages = [
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username sudah ada.',
            'firstname.required' => 'Nama depan harus diisi.',
            'lastname.required' => 'Nama belakang harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah ada.',
            'roles.required' => 'Role harus diisi.',
            'foto.image' => 'Foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berupa gambar.',
            'foto.max' => 'Foto maksimal 2MB.',
        ];
        $this->validators($attributes, $rules, $messages);

        $roles = $request->input('roles');

        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->username = $request->input('username');
            $user->first_name = $request->input('firstname');
            $user->last_name = $request->input('lastname');
            $user->email = $request->input('email');
            $user->save();

            $user->roles()->detach();
            $user->syncRoles($roles);

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $foto_name = $user->id . '.' . $foto->getClientOriginalExtension();

                // Resize the image to 256x256
                $resizedImage = Image::make($foto)->fit(256, 256);
                $resizedImage->save(public_path('assets/images/user') . '/' . $foto_name);

                $user->foto = $foto_name;
                $user->save();
            }

            DB::commit();
            $response = responseSuccess('User berhasil diubah.');
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            DB::rollback();
            $response = responseFail('User gagal diubah.', $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function resetpassword($uuid, Request $request)
    {
        is_uuid($uuid);
        $attributes = $request->only(['password', 'confirm_password']);
        $attributes['id'] = $uuid;

        $rules = [
            'id' => 'required|exists:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exist' => trans('messages.exist'),
            'same' => trans('messages.same'),
        ];
        $this->validators($attributes, $rules, $messages);

        DB::beginTransaction();
        try {
            $user = User::find($uuid);
            $user->password = Hash::make($request->input('password'));
            $user->save();
            DB::commit();
            $response = responseSuccess('Password berhasil diubah.');
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            DB::rollback();
            $response = responseFail('Password gagal diubah.', $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function simulate($id)
    {
        $user = User::find($id);
        Auth::user()->impersonate($user);
        return responseSuccess(trans("messages.simulate-success"), []);
    }

    public function leaveSimulate()
    {
        Auth::user()->leaveImpersonation();
        return redirect('/login');
    }

    public function destroy($id)
    {
        is_uuid($id);
        DB::beginTransaction();
        try {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $data = User::where('id', $id)->delete();
            DB::commit();
            $response = responseSuccess('User berhasil dihapus.');
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            DB::rollback();
            $response = responseFail('User gagal dihapus.', $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
