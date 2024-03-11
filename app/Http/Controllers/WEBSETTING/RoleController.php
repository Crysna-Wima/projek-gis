<?php

namespace App\Http\Controllers\WEBSETTING;

use App\DataTables\WEBSETTING\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Action;
use App\Models\RoleHasMenu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Rules\OnlyOneRules;
use Illuminate\Support\Facades\Artisan;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $menus          = Menu::with('menuchilds')->get();
        $collect        = collect($menus)->where('type', 'dashboard');
        $data['menu']   = $collect;
        $data['actions'] = Action::select('id', 'name')->get();
        $data['menus']  = $this->getDashboardMenu();
        $data['permissions'] = Menu::select('id','name')->where('parent_id',0)->orderBy('order_no', 'asc')->get()->values();
        $data['actionArr'] = Action::orderBy('id')->pluck('action')->toArray();
        return view('websetting.role', $data);
    }

    public function datatables(Request $request, RoleDataTable $roleDataTable)
{
    $s_name = $request->input('columns.1.search.value');
    $s_description = $request->input('columns.2.search.value');

    $query = Role::query()
        ->when($s_name, function ($query, $s_name) {
            return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($s_name) . '%']);
        })
        ->when($s_description, function ($query, $s_description) {
            if ($s_description) {
                return $query->whereRaw('LOWER("desc") LIKE ?', ['%' . strtolower($s_description) . '%']);
            }
            return $query;
        })
        ->orderBy('id', 'asc');

    return $roleDataTable->dataTable($query)->toJson();
}

    
    public function store(Request $request)
    {
        $attributes = $request->only('name', 'description');

        $roles = [
            'name' => 'required|unique:roles',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'unique'   => trans('messages.unique'),
        ];
        $this->validators($attributes, $roles, $messages);

        DB::beginTransaction();
        try {
            //code...
            $attributes['created_by'] = Auth()->user()->id;
            $data = Role::create([
                'name' => $attributes['name'],
                'desc' => $attributes['description'],
            ]);
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:roles',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Role::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {
        $attributes['id']   = $id;
        $attributes['desc'] = $request->get('description');
        $attributes['name'] = ["find" => 'id', "data" => $id, 'name' => $request->get('name'), "tables" => "roles"];

        $roles = [
            'id'   => 'required|exists:roles',
            'name' => ["required", new OnlyOneRules],
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];
        $this->validators($attributes, $roles, $messages);

        unset($attributes['id']);
        unset($attributes['name']);
        $data = $this->findDataWhere(Role::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            $attributes['name'] = $request->get('name');
            $attributes['updated_by'] = Auth()->user()->id;
            $data->update($attributes);
            // $data->update(['name' => $request->get('name'), '']);
            DB::commit();
            $response = responseSuccess(trans("messages.update-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.update-fail"), $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function access($roles)
    {
        $idroles = DB::table('role_has_permissions')->select('permission_id')->where('role_id', $roles)->get()->pluck('permission_id');
        $data['data']    = DB::table('permissions')->select('name')->wherein('id', $idroles)->get();
        $data['test'] =  Role::where('id',$roles)->first();
        $response = responseSuccess(trans("messages.create-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function sycrnaccess(Request $request,$id)
    {
        Artisan::call('cache:clear');
        $rolesid = $id;
        $attributes = $request->only('datas');

        /* validation */
        $roles = [
            'datas' => "required|array",
        ];
        $messages = [
            'required' => trans('messages.required'),
            'array'    => trans('messages.array'),
        ];
        $this->validators($attributes, $roles, $messages);
        /*End Validation Header*/

        /*Validation */
        $roles = [
            //'rolesid' => "required",
            'sidebar' => "required",
            'value'   => "required",
        ];

        $role        = '';
        $arrRoleMenu = [];
        foreach ($attributes['datas'] as $value) {
            # code...
            $this->validators($value, $roles, $messages);
            $role = $rolesid;
        }

        $syncMenu        = collect($attributes['datas'])->unique('sidebar')->pluck('sidebar');
        $temp_syncmenu = array();
        
        foreach($syncMenu as $detail){
            $menu = Menu::where('permission',$detail)->first();

            if (!empty($menu)){
                array_push($temp_syncmenu,$menu->id);
            }
        }
        
        $syncPermissions = collect($attributes['datas'])->unique('value')->pluck('value');
        $syncMenus = Menu::select('parent_id')->wherein('id', $temp_syncmenu)->pluck('parent_id')->unique();
        
        foreach ($syncMenu as $key) {
            # code...
            array_push($arrRoleMenu, ['role_id' => $role, 'menu_id' => $key]);
        }

        foreach ($syncMenus as $key) {
            # code...
            array_push($arrRoleMenu, ['role_id' => $role, 'menu_id' => $key]);
        }
        
        $arrRoleMenu = collect($arrRoleMenu)->where('menu_id', '!=', 0)->toArray();
        
        $roles = Role::find($role);

        DB::beginTransaction();
        try {
            $roles->syncPermissions($syncPermissions);
            $menusyncr = RoleHasMenu::where('role_id', $role)->delete();
            foreach($temp_syncmenu as $detail){
                $arrRoleMenu = array(
                    "role_id" => $rolesid,
                    'menu_id' => $detail
                );
                $menusRole = RoleHasMenu::insert($arrRoleMenu);
            }
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $attributes['datas']);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response           = responseFail(trans("messages.create-fail"));
            $response['errors'] = $e->getMessage();
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }

    }

    public function destroy($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:roles',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];
        $this->validators($attributes, $roles, $messages);

        $data = $this->findDataWhere(Role::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            RoleHasMenu::where('role_id', $id)->delete();
            $data->delete();
            DB::commit();
            $response = responseSuccess(trans("messages.delete-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $e->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
