<?php

namespace App\Http\Controllers\WEBSETTING;

use App\Http\Controllers\Controller;
use App\Models\GlobalVar;
use App\Models\Permission;
use App\Models\Routes;
use App\DataTables\WEBSETTING\RouteDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index(){
        $data['menus']   = $this->getDashboardMenu();
        $data['method'] = GlobalVar::select('value')->where([['group', 'ROUTE'],['name','METHOD']])->get();
        $data['permission'] = Permission::all();
        return view('WEBSETTING.route', $data);
    }

    public function datatables(Request $request, RouteDatatable $routeDataTable)
    {
        $s_method = $request->input('columns.2.search.value');
        $s_url = $request->input('columns.3.search.value');
        $s_route = $request->input('columns.4.search.value');
        $s_guard = $request->input('columns.5.search.value');
        $s_type = $request->input('columns.6.search.value');
        $s_middleware = $request->input('columns.7.search.value');
        $s_permission = $request->input('columns.8.search.value');

        $query = Routes::query()
            ->select('id', 'method', 'url', 'route', 'guard', 'type', 'middleware', 'permission')
            ->when($s_method, function ($query, $s_method) {
                return $query->whereRaw('LOWER(method) LIKE ?', ['%' . strtolower($s_method) . '%']);
            })
            ->when($s_url, function ($query, $s_url) {
                return $query->whereRaw('LOWER(url) LIKE ?', ['%' . strtolower($s_url) . '%']);
            })
            ->when($s_route, function ($query, $s_route) {
                return $query->whereRaw('LOWER(route) LIKE ?', ['%' . strtolower($s_route) . '%']);
            })
            ->when($s_guard, function ($query, $s_guard) {
                return $query->whereRaw('LOWER(guard) LIKE ?', ['%' . strtolower($s_guard) . '%']);
            })
            ->when($s_type, function ($query, $s_type) {
                return $query->whereRaw('LOWER(type) LIKE ?', ['%' . strtolower($s_type) . '%']);
            })
            ->when($s_middleware, function ($query, $s_middleware) {
                return $query->whereRaw('LOWER(middleware) LIKE ?', ['%' . strtolower($s_middleware) . '%']);
            })
            ->when($s_permission, function ($query, $s_permission) {
                return $query->whereRaw('LOWER(permission) LIKE ?', ['%' . strtolower($s_permission) . '%']);
            });
        return $routeDataTable->dataTable($query)->toJson();
    }

    public function store(Request $request)
    {
        $attributes = $request->all();

        $rules = [
            'method' => 'required|in:GET,POST,PUT,DELETE',
            'url' => 'required',
            'route' => 'required',
            'guard' => 'required|in:web,api',
            'type' => 'required|in:data,view',
            'middleware' => 'required',
        ];
        $messages = [
            'required' => 'The :attribute field is required.',
            'in' => 'The :attribute field is invalid.',
        ];

        $this->validators($attributes, $rules, $messages);
        DB::beginTransaction();
        try {
            $attributes['created_by'] = Auth()->user()->id;
            $data = Routes::create($attributes);
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Data successfully created'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Data failed to create'];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $rules = [
            'id' => 'required|exists:routes,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists' => trans('messages.exists'),
        ];

        $this->validators($attributes, $rules, $messages);

        $data = $this->findDataWhere(Routes::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update($id, Request $request)
    {
        $attributes = $request->only(['method', 'url', 'route', 'guard', 'type', 'permission', 'middleware']);

        $rules = [
            'method' => 'required|in:GET,POST,PUT,DELETE',
            'url' => 'required',
            'route' => 'required',
            'guard' => 'required|in:web,api',
            'type' => 'required|in:data,view',
            'middleware' => 'required',
        ];
        $messages = [
            'required' => 'The :attribute field is required.',
            'in' => 'The :attribute field is invalid.',
        ];

        $this->validators($attributes, $rules, $messages);

        $data = $this->findDataWhere(Routes::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            $attributes['updated_by'] = Auth()->user()->id;
            $data->update($attributes);
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Data successfully updated'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Data failed to update'];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }

    public function destroy($id)
    {
        $data = $this->findDataWhere(Routes::class, ['id' => $id]);
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Data successfully deleted'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Data failed to delete'];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }
}
