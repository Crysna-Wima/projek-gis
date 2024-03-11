<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Permission;
use App\DataTables\WEBSETTING\PermissionDataTable;
use DB;
use Auth;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        return view('websetting.permission', $data);
    }

    public function datatables(Request $request, PermissionDataTable $permissionDataTable)
    {
        $s_name = $request->input('columns.1.search.value');
        if ($s_name != null || $s_name == 'null' || $s_name == 'undefined') {
            $s_name = Menu::where('id', $s_name)->first()->permission;
        }
        $s_guard_name = $request->input('columns.2.search.value');
        $s_action_id = $request->input('columns.3.search.value');
        $query    = Permission::query()
            ->select('id', 'name', 'guard_name', 'action_id')
            ->when($s_name, function ($query, $s_name) {
                return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($s_name) . '%']);
            })
            ->when($s_guard_name, function ($query, $s_guard_name) {
                return $query->whereRaw('LOWER(guard_name) LIKE ?', ['%' . strtolower($s_guard_name) . '%']);
            })
            ->when($s_action_id, function ($query, $s_action_id) {
                return $query->whereRaw('LOWER(action_id) LIKE ?', ['%' . strtolower($s_action_id) . '%']);
            });
        return $permissionDataTable->dataTable($query)->toJson();
    }

    public function store(Request $request)
    {
        $attributes = $request->only(['menu', 'action']);

        $rules = [
            'menu' => 'required|exists:menu,id',
            'action' => 'required',
        ];
        $messages = [
            'menu.required' => 'Menu is required',
            'menu.exists' => 'Menu is not exists',
            'action.required' => 'Action is required',
        ];
        $this->validators($attributes, $rules, $messages);

        DB::beginTransaction();
        try {
            $attributes['created_by'] = Auth::user()->id;
            $temp_action = explode(',', $attributes['action']);
            $menu_data = Menu::where('id', $attributes['menu'])->first();
            $data = array();
            foreach ($temp_action as $key => $value) {
                $attributes['name'] = $menu_data->permission . '-' . $value;
                $attributes['guard_name'] = 'web';
                $attributes['action_id'] = $value;
                $attributes['menu_id'] = $attributes['menu'];
                $data[] = Permission::create($attributes);
            }
            DB::commit();
            $response = responseSuccess(trans("messages.create-success"), $data);
            return response()->json($response, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $response = responseFail(trans("messages.create-fail"), $th->getMessage());
            return response()->json($response, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function destroy($id)
    {
        $attributes['id'] = $id;

        $rules = [
            'id' => 'required|exists:permissions,id',
        ];
        $messages = [
            'id.required' => 'ID is required',
            'id.exists' => 'ID is not exists',
        ];
        $this->validators($attributes, $rules, $messages);

        $data = $this->findDataWhere(Permission::class, ['id' => $id]);
        DB::beginTransaction();
        try {
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
