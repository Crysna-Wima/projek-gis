<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\CurahHujanDatatable;
use App\Http\Controllers\Controller;
use App\Models\CurahHujan;
use App\Models\Menu;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurahHujanController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['kota'] = Regency::where('province_id', '35')->get();
        $tahun_now = date('Y');
        $bulan_now = date('m');
        $data['curah_hujan'] = CurahHujan::with('kota')->where('tahun', $tahun_now)->where('bulan', $bulan_now)->get();
        $data['tahun_now'] = $tahun_now;
        $data['bulan_now'] = $bulan_now;

        return view('masterdata.CurahHujan.index', $data);
    }

    public function datatables(Request $request, CurahHujanDatatable $curahHujanDatatable)
    {
        $s_kota = $request->input('columns.1.search.value');
        $s_tahun = $request->input('columns.2.search.value');
        $s_bulan = $request->input('columns.3.search.value');
        $s_curah_hujan = $request->input('columns.4.search.value');
    
        $query = CurahHujan::query()
            ->with('kota')
            ->select('id','id_kota','tahun','bulan','curah_hujan')
            ->when($s_bulan, function ($query, $s_bulan) {
                return $query->whereRaw('LOWER(bulan) LIKE ?', ['%' . strtolower($s_bulan) . '%']);
            })
            ->when($s_curah_hujan, function ($query, $s_curah_hujan) {
                return $query->whereRaw('LOWER(curah_hujan) LIKE ?', ['%' . strtolower($s_curah_hujan) . '%']);
            })
            ->when($s_kota, function ($query, $s_kota) {
                return $query->where('id_kota', $s_kota);
            })
            ->when($s_tahun, function ($query, $s_tahun) {
                return $query->where('tahun', $s_tahun);
            })
            ->orderBy('id', 'asc');
    
        return $curahHujanDatatable->dataTable($query)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'bulan' => 'required|min:1|max:12',
            'curah_hujan' => 'required'
        ]);

        $check = CurahHujan::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }
    
        $data = $request->all();
        $data['id_kota'] = $request->kota;
        $data['tahun'] = $request->tahun;
        $data['bulan'] = $request->bulan;
        $data['curah_hujan'] = $request->curah_hujan;
    
        $curah_hujan = CurahHujan::create($data);
    
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:t_curah_hujan,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(CurahHujan::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->only(['kota', 'tahun', 'bulan', 'curah_hujan']);
        $roles = [
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'bulan' => 'required|min:1|max:12',
            'curah_hujan' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $check = CurahHujan::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->where('id', '!=', $id)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }

        $this->validators($attributes, $roles, $messages);
        $data = $this->findDataWhere(CurahHujan::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'id_kota' => $request->kota,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'curah_hujan' => $request->curah_hujan
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

    public function destroy($id)
    {
        $data = $this->findDataWhere(CurahHujan::class, ['id' => $id]);
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
        $bulan = $request->input('bulan', date('m'));
        
        if ($bulan == null || $bulan == '' || $bulan == 0 || $bulan == 'undefined') {
            $bulan = date('m');
        }
    
        if ($tahun == null || $tahun == '' || $tahun == 0 || $tahun == 'undefined') {
            $tahun = date('Y'); // Default to current year if invalid
        }
    
        $curah_hujan = CurahHujan::with('kota')
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->get();
    
        return response()->json(['status' => 'success', 'data' => $curah_hujan]);
    }
}
