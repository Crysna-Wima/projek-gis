<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\IrigasiDatatable;
use App\Models\Menu;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Irigasi;
use App\Models\Jenis_Irigasi;
use Illuminate\Support\Facades\DB;

class IrigasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['kota'] = Regency::where('province_id', '35')->get();
        $data['id_jenis_irigasi'] = Jenis_Irigasi::get();
        $tahun_now = date('Y');
        $data['irigasi'] = Irigasi::with('kota')->with('jenis_irigasi')->where('tahun', $tahun_now)->get();
        $data['tahun_now'] = $tahun_now;

        return view('masterdata.irigasi.index', $data);
    }

    /**
     * Datatables the form for creating a new resource.
     */
    public function datatables(Request $request, IrigasiDatatable $irigasiDatatable)
    {
        $s_kota = $request->input('columns.1.search.value');
        $s_tahun = $request->input('columns.2.search.value');
        $s_id_jenis_irigasi = $request->input('columns.3.search.value');
        $s_luas = $request->input('columns.4.search.value');
    
        $query = Irigasi::query()
            ->with('kota')
            ->with('jenis_irigasi')
            ->select('id','id_kota','tahun','id_jenis_irigasi','luas')
            ->when($s_id_jenis_irigasi, function ($query, $s_id_jenis_irigasi) {
                return $query->where('id_jenis_irigasi', $s_id_jenis_irigasi);
            })
            ->when($s_luas, function ($query, $s_luas) {
                return $query->whereRaw('LOWER(luas) LIKE ?', ['%' . strtolower($s_luas) . '%']);
            })
            ->when($s_kota, function ($query, $s_kota) {
                return $query->where('id_kota', $s_kota);
            })
            ->when($s_tahun, function ($query, $s_tahun) {
                return $query->where('tahun', $s_tahun);
            })
            ->orderBy('id', 'asc');
    
        return $irigasiDatatable->dataTable($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'id_jenis_irigasi' => 'required|exists:jenis__irigasis,id',
            'luas' => 'required'
        ]);

        $check = Irigasi::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('id_jenis_irigasi', $request->id_jenis_irigasi)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }
    
        $data = $request->all();
        $data['id_kota'] = $request->kota;
        $data['tahun'] = $request->tahun;
        $data['id_jenis_irigasi'] = $request->id_jenis_irigasi;
        $data['luas'] = $request->luas;
    
        $irigasi = Irigasi::create($data);
    
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:t_irigasi,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Irigasi::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->only(['kota', 'tahun', 'id_jenis_irigasi', 'luas']);
        $roles = [
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'id_jenis_irigasi' => 'required|exists:jenis__irigasis,id',
            'luas' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $check = Irigasi::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('id_jenis_irigasi', $request->id_jenis_irigasi)
            ->where('id', '!=', $id)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }

        $this->validators($attributes, $roles, $messages);
        $data = $this->findDataWhere(Irigasi::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'id_kota' => $request->kota,
                'tahun' => $request->tahun,
                'id_jenis_irigasi' => $request->id_jenis_irigasi,
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
        $data = $this->findDataWhere(Irigasi::class, ['id' => $id]);
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
        $jenis_irigasi = $request->input('jenis_irigasi');

        if ($tahun == null || $tahun == '' || $tahun == 0 || $tahun == 'undefined') {
            $tahun = date('Y'); // Default to current year if invalid
        }
        
        if ($jenis_irigasi == null || $jenis_irigasi == '' || $jenis_irigasi == 0 || $jenis_irigasi == 'undefined') {
            $irigasi = Irigasi::with('kota')->with('jenis_irigasi')
            ->where('tahun', $tahun)
            ->get();
        } else {
            $irigasi = Irigasi::with('kota')->with('jenis_irigasi')
                ->where('tahun', $tahun)
                ->where('id_jenis_irigasi', $jenis_irigasi)
                ->get();
        }
        
    
        return response()->json(['status' => 'success', 'data' => $irigasi]);
    }
}
