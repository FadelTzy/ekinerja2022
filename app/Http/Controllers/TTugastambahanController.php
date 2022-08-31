<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_tugastambahan;
use App\Models\t_jabatan;
use Illuminate\Support\Facades\Auth;
use App\Models\KinerjaUtama;
use Illuminate\Support\Facades\Session;
use App\Models\t_periode;
use App\Models\Manajemen_p;
use App\Models\target_semester;

class TTugastambahanController extends Controller
{
    public function index()
    {
        try {

            if (Session::has('period')) {
                $idp = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $period  = t_periode::where('id', $idp)->first();
                $jab = Manajemen_p::select('id_jab', 'id', 'status_target', 'status_tugas')->where('id_peg', $id_peg)->where('id_ped', $idp)->first();
                $jabatan  = t_jabatan::where('id', $jab->id_jab)->first();
                $smst = '';

                if (request()->ajax()) {
                    return datatables()->of(t_tugastambahan::where(function ($query) use ($jab) {
                        $query->where('id_mn', $jab->id);
                    })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                        $b = "<button class='btn btn-sm btn-bordered-warning waves-effect waves-light mr-2' onclick='editj(" . json_encode($data)  . ");'> Edit </button>";
                        $b .= "<button type='button' class='btn btn-sm btn-bordered-danger waves-effect waves-light' onclick=delj('" . $data->id . "')> Hapus </button>";
                        return $b;
                    })->addColumn('tkuan', function ($data) {
                        $anu = $data->tkuantitas . ' - ' . $data->tkuantitasmax ?? '0';
                        return strval($anu) . ' ' . $data->satuan;
                    })->addColumn('tkual', function ($data) {
                        $anu =  $data->tkualitas . ' - ' . $data->tkualitasmax ?? '0';
                        return strval($anu) . ' ' . $data->satuankualitas;
                    })->addColumn('twaktu', function ($data) {
                        $anu = $data->twaktu . ' - ' . $data->twaktumax ?? '0';
                        return strval($anu) . ' ' . $data->satuanwaktu;
                    })->addColumn('ket', function ($data) {
                        return $data->ket;
                    })->rawColumns(['aksi', 'tugas', 'bulam', 'tkuan', 'tkual', 'ket'])->make(true);
                }
            } else {
                $period = "null";
                $jab = "null";
            }

            return view('user.rancangan.tugastambahan', compact('period', 'jab', 'jabatan'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function destroy($id)
    {
        $res = t_tugastambahan::where('id', $id)->first();

        if ($res) {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_tugas' => null]);
                $res->delete();
                return "success";
            }
        }
        return "fail";
    }
    public function update(Request $request, $id)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $saved = t_tugastambahan::where('id', $request->idu)->update([
                    'tugas' => $request->aktivitasu,
                    'keterangan' => $request->keteranganu,

                    'tkuantitas' => $request->kuantitasmin,
                    'tkuantitasmax' => $request->kuantitasmax,
                    'ikikuantitas' => $request->ikikuantitas,
                    'satuankuantitas' => $request->satuankuantitas,

                    'tkualitas' => $request->kualitasmin,
                    'tkualitasmax' => $request->kualitasmax,
                    'ikikualitas' => $request->ikikualitas,
                    'satuankualitas' => $request->satuankualitas,

                    'twaktu' => $request->waktumin,
                    'twaktumax' => $request->waktumax,
                    'ikiwaktu' => $request->ikiwaktu,
                    'satuanwaktu' => $request->satuanwaktu,
                ]);
                if ($saved) {
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_tugas' => 1]);
                }
            }
            return 'success';
        } catch (\Throwable $th) {
            return $th;
        }
        if ($saved) {
            return response()->json(['success' => 'Data Berhasil Terupload']);
        }
    }

    public function store(Request $request)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $jab = Manajemen_p::select('id_jab', 'id', 'id_ped', 'id_peg')->where('id_peg', $id_peg)->where('id_ped', $id)->first();
                $saved = t_tugastambahan::create([
                    'tugas' => $request->aktivitas,

                    'tkuantitas' => $request->kuantitasmin,
                    'tkuantitasmax' => $request->kuantitasmax,
                    'satuankuantitas' => $request->satuankuantitas,
                    'ikikuantitas' => $request->ikikuantitas,

                    'tkualitas' => $request->kualitasmin,
                    'tkualitasmax' => $request->kualitasmax,
                    'ikikualitas' => $request->ikikualitas,
                    'satuankualitas' => $request->satuankualitas,

                    'twaktu' => $request->waktumin,
                    'twaktumax' => $request->waktumax,
                    'ikiwaktu' => $request->ikiwaktu,
                    'satuanwaktu' => $request->satuanwaktu,


                    'id_periode' => $jab->id_ped,
                    'id_mn' => $jab->id,
                    'keterangan' => $request->keterangan ?? '-',
                    'nilai_mutu' => 0,
                    'nilai_capaian' => 0,
                    'id_peg' => $jab->id_peg,
                    'status' =>  '0',

                ]);
                if ($saved) {
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_tugas' => 3]);
                }
            }
            return 'success';
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
