<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_periode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Manajemen_p;
use App\Models\t_tupoksi;
use App\Models\t_jabatan;
use App\Models\target_semester;
use App\Models\KinerjaUtama;

class KinerjaUtamaController extends Controller
{
    public function editskp(Request $request)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $saved = target_semester::where('id', $request->idu)->update([
                    'kegiatan' => $request->aktivitasu,
                    'id_tup' => $request->idtugasu,
                    'ket' => $request->keteranganu,

                    'tkuantitas' => $request->kuantitasmin,
                    'tkuantitasmax' => $request->kuantitasmax,
                    'ikikuantitas' => $request->ikikuantitas,
                    'satuan' => $request->satuankuantitas,

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
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_target' => 3]);
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
    public function createskp($id)
    {
        $daker = KinerjaUtama::where('id', $id)->select('rencana', 'id')->first();
        try {
            $smstr1 = [
                ['no' => 1, 'bulan' => 'Januari'],
                ['no' => 2, 'bulan' => 'Februari'],
                ['no' => 3, 'bulan' => 'Maret'],
                ['no' => 4, 'bulan' => 'April'],
                ['no' => 5, 'bulan' => 'Mei'],
                ['no' => 6, 'bulan' => 'Juni'],

            ];
            $smstr2 = [
                ['no' => 7, 'bulan' => 'Juli'],
                ['no' => 8, 'bulan' => 'Agustus'],
                ['no' => 9, 'bulan' => 'September'],
                ['no' => 10, 'bulan' => 'Oktober'],
                ['no' => 11, 'bulan' => 'November'],
                ['no' => 12, 'bulan' => 'Desember'],

            ];
            if (Session::has('period')) {
                $idrencana = $id;
                $idp = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $period  = t_periode::where('id', $idp)->first();
                $jab = Manajemen_p::select('id_jab', 'id')->where('id_peg', $id_peg)->where('id_ped', $idp)->first();
                $jabatan  = t_jabatan::where('id', $jab->id_jab)->first();
                $smst = '';
                if ($period->semester == 1) {
                    $smst = json_decode(json_encode($smstr1));
                } else {
                    $smst = json_decode(json_encode($smstr2));
                }
                if (request()->ajax()) {
                    return datatables()->of(target_semester::where(function ($query) use ($idrencana, $jab) {
                        $query->where('id_rencana', $idrencana)
                            ->where('id_ped', $jab->id)
                            ->where('status_adendum', '!=', '3');
                    })->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                        $data['tt'] = $data->tupoksi->uraian;
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
                    })->addColumn('tugas', function ($data) {
                        return $data->tupoksi->uraian;
                    })->rawColumns(['aksi', 'tugas', 'bulam', 'tkuan', 'tkual', 'ket'])->make(true);
                }
            } else {
                $period = "null";
                $jab = "null";
            }

            return view('user.rancangan.rekin', compact('period', 'id', 'jab', 'jabatan', 'smst', 'daker'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function create()
    {

        try {
            $smstr1 = [
                ['no' => 1, 'bulan' => 'Januari'],
                ['no' => 2, 'bulan' => 'Februari'],
                ['no' => 3, 'bulan' => 'Maret'],
                ['no' => 4, 'bulan' => 'April'],
                ['no' => 5, 'bulan' => 'Mei'],
                ['no' => 6, 'bulan' => 'Juni'],

            ];
            $smstr2 = [
                ['no' => 7, 'bulan' => 'Juli'],
                ['no' => 8, 'bulan' => 'Agustus'],
                ['no' => 9, 'bulan' => 'September'],
                ['no' => 10, 'bulan' => 'Oktober'],
                ['no' => 11, 'bulan' => 'November'],
                ['no' => 12, 'bulan' => 'Desember'],

            ];
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $period  = t_periode::where('id', $id)->first();
                $jab = Manajemen_p::select('id_jab', 'status_target', 'ket', 'id')->where('id_peg', $id_peg)->where('id_ped', $id)->first();
                $jabatan  = t_jabatan::where('id', $jab->id_jab)->first();
                $smst = '';
                if ($period->semester == 1) {
                    $smst = json_decode(json_encode($smstr1));
                } else {
                    $smst = json_decode(json_encode($smstr2));
                }

                if (request()->ajax()) {
                    return datatables()->of(KinerjaUtama::with('target')->where('manajemen_ps', $jab->id)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                        $b = "<button class='btn btn-sm btn-bordered-warning waves-effect waves-light mr-2' onclick='editj(" . json_encode($data)  . ");'> Edit </button>";
                        $b .= "<button type='button' class='btn btn-sm btn-bordered-danger waves-effect waves-light' onclick=delj('" . $data->id . "')> Hapus </button>";
                        return $b;
                    })->addColumn('total', function ($data) {
                        return $data->target->count();
                    })->addColumn('status', function ($data) use ($jab) {
                        if ($jab->status_target == 1) {
                            $b = "<span class='text-mute'>Target telah disetujui</span>";
                        } else {
                            $b = "<a href='" . url('/skp/rancangan/kinerja-utama/create/') . '/' . $data->id . "' type='button' class='btn btn-sm btn-bordered-success waves-effect waves-light' > <i class='mdi mdi-clipboard-text-multiple-outline'></i> </a>";
                        }
                        return $b;
                    })->addColumn('ket', function ($data) {
                        return $data->ket;
                    })->rawColumns(['aksi', 'bulam', 'total', 'status', 'ket'])->make(true);
                }
            } else {
                $period = "null";
                $jab = "null";
            }

            return view('user.rancangan.kinerja', compact('period', 'jab', 'jabatan', 'smst'));
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function store(Request $request)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $jab = Manajemen_p::select('id_jab', 'id')->where('id_peg', $id_peg)->where('id_ped', $id)->first();
                $saved = KinerjaUtama::create([
                    'rencana' => $request->kinerja,
                    'id_pegawai' => $id_peg,
                    'id_periode' => $id,
                    'manajemen_ps' => $jab->id,
                    'status' =>  '0',
                    'ket' => '0'
                ]);
                if ($saved) {
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_target' => 3]);
                }
            }
            return 'success';
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function storeskp(Request $request)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $jab = Manajemen_p::select('id_jab', 'id')->where('id_peg', $id_peg)->where('id_ped', $id)->first();
                $saved = target_semester::create([
                    'id_tup' => $request->idtugas,
                    'kegiatan' => $request->aktivitas,
                    'tkuantitas' => $request->kuantitasmin,
                    'tkuantitasmax' => $request->kuantitasmax,
                    'ikikuantitas' => $request->ikikuantitas,
                    'satuan' => $request->satuankuantitas,
                    'id_rencana' => $request->idrencana,
                    'tkualitas' => $request->kualitasmin,
                    'tkualitasmax' => $request->kualitasmax,
                    'ikikualitas' => $request->ikikualitas,
                    'satuankualitas' => $request->satuankualitas,

                    'twaktu' => $request->waktumin,
                    'twaktumax' => $request->waktumax,
                    'ikiwaktu' => $request->ikiwaktu,
                    'satuanwaktu' => $request->satuanwaktu,

                    'id_ped' => $jab->id,
                    'ket' => $request->keterangan ?? '-',
                    'nilai_mutu' => 0,
                    'status' =>  '0',
                    'status_adendum' => '0'

                ]);
                if ($saved) {
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_target' => 3]);
                }
            }
            return 'success';
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(Request $request)
    {
        try {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                $saved = KinerjaUtama::where('id', $request->idu)->update([
                    'rencana' => $request->kinerja,
                ]);
                if ($saved) {
                    Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_target' => 3]);
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
    public function destroy($id)
    {
        $res = KinerjaUtama::findOrFail($id);
        if ($res) {
            if (Session::has('period')) {
                $id = Session::get('period');
                $id_peg = Auth::user()->id_peg;
                target_semester::where('id_rencana', $id)->delete();
                Manajemen_p::where('id_peg', $id_peg)->where('id_ped', $id)->update(['status_target' => 3]);
            }
            $res->delete();
            return "success";
        }
        return "fail";
    }
}
