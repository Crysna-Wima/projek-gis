<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\JenisTanahDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Regency;
use App\Models\JenisTanah;
use App\Models\Jenis_Tanah;
use Illuminate\Support\Facades\DB;

class JenisTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['kota'] = Regency::where('province_id', '35')->get();
        $data['id_jenis_tanah'] = Jenis_Tanah::get();
        $jenis_tanah = 6;
        $data['jenis_tanah'] = JenisTanah::with('kota')->where('id_jenis_tanah', $jenis_tanah)->get();
        $data['jenis_tanah_now'] = $jenis_tanah;

        return view('masterdata.jenistanah.index', $data);
    }

    /**
     * Datatables the form for creating a new resource.
     */
    public function datatables(Request $request, JenisTanahDatatable $JenisTanahDatatable)
    {
        $s_kota = $request->input('columns.1.search.value');
        $s_id_jenis_tanah = $request->input('columns.2.search.value');
        $s_luas = $request->input('columns.3.search.value');
    
        $query = JenisTanah::query()
            ->with('kota')
            ->select('id','id_kota','id_jenis_tanah','luas')
            ->when($s_id_jenis_tanah, function ($query, $s_id_jenis_tanah) {
                return $query->where('id_jenis_tanah', $s_id_jenis_tanah);
            })
            ->when($s_luas, function ($query, $s_luas) {
                return $query->whereRaw('LOWER(luas) LIKE ?', ['%' . strtolower($s_luas) . '%']);
            })
            ->when($s_kota, function ($query, $s_kota) {
                return $query->where('id_kota', $s_kota);
            })
            ->orderBy('id', 'asc');
    
        return $JenisTanahDatatable->dataTable($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required|exists:regencies,id',
            'id_jenis_tanah' => 'required|exists:jenis__tanahs,id',
            'luas' => 'required'
        ]);

        $check = JenisTanah::where('id_kota', $request->kota)
            ->where('id_jenis_tanah', $request->id_jenis_tanah)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }
    
        $data = $request->all();
        $data['id_kota'] = $request->kota;
        $data['id_jenis_tanah'] = $request->id_jenis_tanah;
        $data['luas'] = $request->luas;
    
        $jenistanah = JenisTanah::create($data);
    
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:t_jenis_tanah,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(JenisTanah::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->only(['kota', 'id_jenis_tanah', 'luas']);
        $roles = [
            'kota' => 'required|exists:regencies,id',
            'id_jenis_tanah' => 'required|exists:jenis__tanahs,id',
            'luas' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $check = JenisTanah::where('id_kota', $request->kota)
            ->where('id_jenis_tanah', $request->id_jenis_tanah)
            ->where('id', '!=', $id)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }

        $this->validators($attributes, $roles, $messages);
        $data = $this->findDataWhere(JenisTanah::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'id_kota' => $request->kota,
                'id_jenis_tanah' => $request->id_jenis_tanah,
                'luas' => $request->luas
            ]);
            DB::commit();
            $messages = ['status' => 'success', 'message' => 'Data berhasil dirubah'];
            return response()->json($messages, 200, [], JSON_PRETTY_PRINT);
        } catch (\Throwable $th) {
            DB::rollback();
            $messages = ['status' => 'error', 'message' => 'Data gagal dirubah', 'error' => $th->getMessage()];
            return response()->json($messages, 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->findDataWhere(JenisTanah::class, ['id' => $id]);
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

    public function searchMap(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $jenis_tanah = $request->input('jenis_tanah', 1);
        
        if ($jenis_tanah == null || $jenis_tanah == '' || $jenis_tanah == 0 || $jenis_tanah == 'undefined') {
            $jenis_tanah = 1; // Default to 1 if invalid
        }
    
        $jenisTanah = JenisTanah::with('kota')
            ->where('id_jenis_tanah', $jenis_tanah)
            ->get();
    
        return response()->json(['status' => 'success', 'data' => $jenisTanah]);
    }
}
