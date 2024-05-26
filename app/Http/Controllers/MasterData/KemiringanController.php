<?php

namespace App\Http\Controllers\MasterData;

use App\DataTables\MasterData\KemiringanDatatable;
use App\Models\Menu;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kemiringan;
use App\Models\Kemiringan_Wilayah;
use Illuminate\Support\Facades\DB;

class KemiringanController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['menus'] = $this->getDashboardMenu();
        $data['menu']  = Menu::select('id', 'name')->get();
        $data['kota'] = Regency::where('province_id', '35')->get();
        $data['id_kemiringan_wilayah'] = Kemiringan_Wilayah::get();

        return view('masterdata.kemiringan.index', $data);
    }

    /**
     * Datatables the form for creating a new resource.
     */
    public function datatables(Request $request, KemiringanDatatable $KemiringanDatatable)
    {
        $s_kota = $request->input('columns.1.search.value');
        $s_id_kemiringan_wilayah = $request->input('columns.2.search.value');
        $s_luas = $request->input('columns.3.search.value');
    
        $query = Kemiringan::query()
            ->with(['kota', 'kemiringanWilayah'])
            ->select('id','id_kota','id_kemiringan_wilayah','luas')
            ->when($s_id_kemiringan_wilayah, function ($query, $s_id_kemiringan_wilayah) {
                return $query->where('id_kemiringan_wilayah', $s_id_kemiringan_wilayah);
            })
            ->when($s_luas, function ($query, $s_luas) {
                return $query->whereRaw('LOWER(luas) LIKE ?', ['%' . strtolower($s_luas) . '%']);
            })
            ->when($s_kota, function ($query, $s_kota) {
                return $query->where('id_kota', $s_kota);
            })
            ->orderBy('id', 'asc');
    
        return $KemiringanDatatable->dataTable($query)->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kota' => 'required|exists:regencies,id',
            'id_kemiringan_wilayah' => 'required|exists:kemiringan__wilayahs,id',
            'luas' => 'required'
        ]);

        $check = Kemiringan::where('id_kota', $request->kota)
            ->where('id_kemiringan_wilayah', $request->id_kemiringan_wilayah)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }
    
        $data = $request->all();
        $data['id_kota'] = $request->kota;
        $data['id_kemiringan_wilayah'] = $request->id_kemiringan_wilayah;
        $data['luas'] = $request->luas;
    
        $kemiringan = Kemiringan::create($data);
    
        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attributes['id'] = $id;

        $roles = [
            'id' => 'required|exists:t_kemiringan,id',
        ];
        $messages = [
            'required' => trans('messages.required'),
            'exists'   => trans('messages.exists'),
        ];

        $this->validators($attributes, $roles, $messages);

        $data     = $this->findDataWhere(Kemiringan::class, ['id' => $id]);
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
        $attributes = $request->only(['kota', 'id_kemiringan_wilayah', 'luas']);
        $roles = [
            'kota' => 'required|exists:regencies,id',
            'id_kemiringan_wilayah' => 'required|exists:kemiringan__wilayahs,id',
            'luas' => 'required'
        ];
        $messages = [
            'required' => trans('messages.required'),
        ];

        $check = Kemiringan::where('id_kota', $request->kota)
            ->where('id_kemiringan_wilayah', $request->id_kemiringan_wilayah)
            ->where('id', '!=', $id)
            ->first();
        
        if ($check) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada']);
        }

        $this->validators($attributes, $roles, $messages);
        $data = $this->findDataWhere(Kemiringan::class, ['id' => $id]);

        DB::beginTransaction();
        try {
            $data->update([
                'id_kota' => $request->kota,
                'id_kemiringan_wilayah' => $request->id_kemiringan_wilayah,
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
        $data = $this->findDataWhere(Kemiringan::class, ['id' => $id]);
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
