<?php

namespace App\Http\Controllers\WEBSETTING;

use App\DataTables\WEBSETTING\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\RoleHasMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function index(){
        $data['menus'] = $this->getDashboardMenu();
        $query = Menu::select('id', 'name', 'icon');
        $data['menu']  = $query->get();
        $data['parent'] = $query
        ->where('parent_id', 0)
        // ->has('menuChilds') // This ensures that only parent menus with children are retrieved
        ->get();
        return view('WEBSETTING.menu', $data);
    }

    public function datatables(Request $request, MenuDataTable $menuDataTable)
    {
        $s_parent = $request->input('columns.2.search.value');
        $s_name = $request->input('columns.4.search.value');
        $s_url = $request->input('columns.5.search.value');
        $s_type = $request->input('columns.6.search.value');
        $s_permission = $request->input('columns.7.search.value');
        $s_status = $request->input('columns.8.search.value');
        // dd($s_status);
    
        $query = Menu::query()
            ->select('id', 'name', 'icon', 'parent_id', 'url', 'type', 'permission', 'status', 'order_no')
            ->when($s_parent !== null, function ($query) use ($s_parent) {
                if ($s_parent === '0') {
                    return $query->where('parent_id', 0);
                } else {
                    return $query->where('parent_id', $s_parent);
                }
            })
            ->when($s_name, function ($query, $s_name) {
                return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($s_name) . '%']);
            })
            ->when($s_url, function ($query, $s_url) {
                return $query->whereRaw('LOWER(url) LIKE ?', ['%' . strtolower($s_url) . '%']);
            })
            ->when($s_type, function ($query, $s_type) {
                return $query->whereRaw('LOWER(type) LIKE ?', ['%' . strtolower($s_type) . '%']);
            })
            ->when($s_permission, function ($query, $s_permission) {
                return $query->whereRaw('LOWER(permission) LIKE ?', ['%' . strtolower($s_permission) . '%']);
            })
            ->when($s_status, function ($query, $s_status) {
                return $query->where('status', $s_status);
            })
            ->orderBy('parent_id', 'asc')
            ->orderBy('order_no', 'asc');
    
        return $menuDataTable->dataTable($query)->toJson();
    }    

    public function store(Request $request){
        $attributes = $request->only(['name', 'url', 'oerder_no', 'icon', 'parent_id', 'type', 'permission']);
        $rules = [
            'name' => 'required',
            'icon' => 'required',
            'type' => 'required',
            'url' => 'required|unique:menu,url',
            'permission' => 'required|unique:menu,permission',
            'parent_id' => 'required|numeric|' . ($attributes['parent_id'] == 0 ? '' : 'exists:menu,id'),
        ];
        $messages = [
            'url.unique' => 'URL sudah ada',
            'permission.unique' => 'Permission sudah ada',
            'parent.exists' => 'Parent tidak ditemukan',
        ];

        $this->validators($attributes, $rules, $messages);

        DB::beginTransaction();
        try {
             //code...
             $attributes['created_by'] = Auth::user()->id;
             $data = Menu::create($attributes);
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Menu berhasil ditambahkan'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Menu gagal ditambahkan', 'error' => $th->getMessage()];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }
    
    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:menu',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Menu::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {

        $attributes = $request->only(['name', 'permission', 'url', 'permission', 'order_no','icon','parent_id', 'type', 'status']);

        $rules = [
            'name' => 'required',
            'icon' => 'required',
            'type' => 'required',
            'url' => ['required', ($attributes['url'] == '#' ? '' : 'exists:menu,url')],
            'permission' => ['required', Rule::unique('menu')->ignore($id)],
            'parent_id' => 'required|numeric|' . ($attributes['parent_id'] == 0 ? '' : 'exists:menu,id'),
            'status' => 'required',
        ];

        $messages = [
            'required' => trans('messages.required'),
            'unique' => 'The :attribute has already been taken.', // Pesan khusus untuk aturan unique
        ];

        $this->validators($attributes, $rules, $messages);
        $data = $this->findDataWhere(Menu::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $attributes['updated_by'] = Auth()->user()->id;
            $data->update($attributes);
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Menu berhasil dirubah'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Menu gagal dirubah', 'error' => $th->getMessage()];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }
    
    public function destroy($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:menu',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];
        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Menu::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            RoleHasMenu::where('menu_id', $id)->delete();
            $data->delete();
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Menu berhasil ditambahkan'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Menu gagal ditambahkan', 'error' => $th->getMessage()];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
