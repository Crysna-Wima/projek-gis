<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\ProduktifitasDatatable;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Produktifitas;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduktifitasController extends Controller
{
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['kota'] = Regency::where('province_id', '35')->get();
        $tahun_now = date('Y');
        $masa_panen = 1;
        if (date('m') >= 1 && date('m') <= 3) {
            $masa_panen = 1;
        } elseif (date('m') >= 4 && date('m') <= 6) {
            $masa_panen = 2;
        } elseif (date('m') >= 7 && date('m') <= 9) {
            $masa_panen = 3;
        } elseif (date('m') >= 10 && date('m') <= 12) {
            $masa_panen = 4;
        }
        $data['produktifitas'] = Produktifitas::with('kota')->where('tahun', $tahun_now)->where('masa_panen', $masa_panen)->get();
        $data['tahun_now'] = $tahun_now;
        $data['masa_panen_now'] = $masa_panen;

        return view('masterdata.produktifitas.index', $data);
    }

    public function datatables(Request $request, ProduktifitasDatatable $produktifitasDatatable)
    {
        $s_kota = $request->input('columns.1.search.value');
        $s_tahun = $request->input('columns.2.search.value');
        $s_masa_panen = $request->input('columns.3.search.value');
        $s_produktifitas = $request->input('columns.4.search.value');
    
        $query = Produktifitas::query()
            ->with('kota')
            ->select('id','id_kota','tahun','masa_panen','produktifitas')
            ->when($s_masa_panen, function ($query, $s_masa_panen) {
                return $query->whereRaw('LOWER(masa_panen) LIKE ?', ['%' . strtolower($s_masa_panen) . '%']);
            })
            ->when($s_produktifitas, function ($query, $s_produktifitas) {
                return $query->whereRaw('LOWER(produktifitas) LIKE ?', ['%' . strtolower($s_produktifitas) . '%']);
            })
            ->when($s_kota, function ($query, $s_kota) {
                return $query->where('id_kota', $s_kota);
            })
            ->when($s_tahun, function ($query, $s_tahun) {
                return $query->where('tahun', $s_tahun);
            })
            ->orderBy('id', 'asc');
    
        return $produktifitasDatatable->dataTable($query)->toJson();
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'masaPanen' => 'required|min:1|max:12',
            'produktifitas' => 'required'
        ]);

        $check = Produktifitas::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('masa_panen', $request->masaPanen)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }
    
        $data = $request->all();
        $data['id_kota'] = $request->kota;
        $data['tahun'] = $request->tahun;
        $data['masa_panen'] = $request->masaPanen;
        $data['produktifitas'] = $request->produktifitas;
    
        $produktifitas = Produktifitas::create($data);
    
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:t_produktifitas,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Produktifitas::class, ['id' => $id]);
        $response = responseSuccess(trans("messages.read-success"), $data);
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->only(['kota', 'tahun', 'masaPanen', 'produktifitas']);
        $roles = [
            'kota' => 'required|exists:regencies,id',
            'tahun' => 'required|max:' . date('Y'),
            'masaPanen' => 'required|min:1|max:12',
            'produktifitas' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $check = Produktifitas::where('id_kota', $request->kota)
            ->where('tahun', $request->tahun)
            ->where('masa_panen', $request->masaPanen)
            ->where('id', '!=', $id)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }

        $this->validators($attributes, $roles, $messages);
        $data = $this->findDataWhere(Produktifitas::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'id_kota' => $request->kota,
                'tahun' => $request->tahun,
                'masa_panen' => $request->masaPanen,
                'produktifitas' => $request->produktifitas
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
        $data = $this->findDataWhere(Produktifitas::class, ['id' => $id]);
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
        $masaPanen = $request->input('masaPanen', 1);
        
        if ($masaPanen == null || $masaPanen == '' || $masaPanen == 0 || $masaPanen == 'undefined') {
            $masaPanen = 1; // Default to 1 if invalid
        }
    
        if ($tahun == null || $tahun == '' || $tahun == 0 || $tahun == 'undefined') {
            $tahun = date('Y'); // Default to current year if invalid
        }
    
        $produktifitas = Produktifitas::with('kota')
            ->where('tahun', $tahun)
            ->where('masa_panen', $masaPanen)
            ->get();
    
        return response()->json(['status' => 'success', 'data' => $produktifitas]);
    }
    
}
