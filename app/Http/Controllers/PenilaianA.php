<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Manajemen_p;
use App\Models\t_periode;
use App\Models\target_semester;
use Illuminate\Support\Facades\Auth;
use App\Models\t_log;
use App\Models\t_rbulan;
use App\Models\t_tahunpegawai;
use App\Models\t_tugastambahan;

class PenilaianA extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkt($id)
    {
        if ($id == 1) {
            return 'table-info';
        } elseif ($id == 2) {
            return 'table-success w-100';
        }
    }
    public function check($id)
    {
        if ($id == 1) {
            return 'table-info';
        } elseif ($id == 2) {
            return 'table-success w-100';
        }
    }
    public function reset()
    {
        $bulan = request()->input('bul');
        $id = request()->input('id');
        $data = target_semester::where(function ($query) use ($id, $bulan) {
            $query->where('id_ped', $id)->where('bulan', $bulan);
        })->update([
            'status' => '1',
            'nilai_atasan' => NULL,
            'nilai_capaian' => null,
            'feedback' => null,
            'nilai_mutu' => null,
        ]);
        return 'success';
    }
    public function isitugas()
    {

        $id = request()->input('id');
        $tbl = '';
        $mn = Manajemen_p::where('id', $id)->select('status_tugas')->first()->status_tugas;

        if ($mn == 4 || $mn == 1) {
            $data = t_tugastambahan::where('id_mn', $id)->where(function ($q) {
                $q->where('status', '1')->orWhere('status', '2');
            })->get();
            $no = 1;
            foreach ($data as $value) {
                $totallog = t_log::where('id_target', $value->id)->get();
                $tbl .= '<tbody class="' . $this->checkt($value->status) . '">
             
                <tr>
                    <th scope="row">' . $no . '</th>
                    <th>Rencana Kinerja</th>
                    <td class="text-left" colspan="3">' . $value->tugas . '</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th>Keterangan</th>
                    <td class="text-left" colspan="3">' . $value->ket . '</td>
                </tr>
                <tr>
                <th class="text-bold" colspan="2"><b>Aspek</b> </th>
    
                <td><b>Indikator Kinerja Individu </b> </td>
                <td><b>Target</b></td>
                <td><b>Realisasi </b></td>
            </tr>
            <tr>
            <th colspan="2"><b>Kuantitas</b> </th>
    
            <td style="width:40%">' . $value->ikikuantitas . '</td>
            <td style="width:15%">' . $value->tkuantitas . ' -' . $value->tkuantitasmax . ' ' . $value->satuankuantitas  . '</td>
            <td style="width:10%"> <div class="form-group">
            <input name="rkuantitas[]" type="number" value="' . $value->rkuantitas . '" class="form-control" >
        </div></td>
        </tr>
        <tr>
        <th colspan="2"><b>Kualitas</b> </th>
    
        <td style="width:40%">' . $value->ikikualitas . '</td>
        <td style="width:15%">' . $value->tkualitas . ' -' . $value->tkualitasmax . ' ' . $value->satuankualitas  . '</td>
        <td style="width:10%"> <div class="form-group">
        <input name="rkualitas[]" type="number" value="' . $value->rkualitas . '" class="form-control" >
    </div></td>
    </tr>
    <tr>
    <th colspan="2"><b>Waktu</b> </th>
    
    <td>' . $value->ikiwaktu . '</td>
    <td>' . $value->twaktu . ' -' . $value->twaktumax . ' ' . $value->satuanwaktu  . '</td>
    <td style="width:20%"> <div class="form-group">
    <input name="rwaktu[]" type="number" value="' . $value->rwaktu . '" class="form-control" >
    </div></td>
    </tr>
                <tr>
                    <th colspan="2"><b>Log Harian</b> : <div class="badge badge-success" type="button" onclick="loghariani(' . $value->id . ')"> ' . $totallog->count() . '</div></th>
    
                    <td class="text-left" colspan="3">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><b>Feedback</b></label>
                            <textarea name="kr[]" placeholder="Keterangan Penilaian" class="form-control" id="exampleFormControlTextarea1" rows="1">' . $value->feedback . '</textarea>
                        </div>
                    </td>
                </tr>
          
                <tr>
                    <td class="" colspan="5"></td>
                </tr>
                <input name="id[]" type="hidden" value="' . $value->id . '">
                <input name="ms" type="hidden" value="' . $id . '">
    
            </tbody><tbody>
            <tr><td></td></tr></tbody>';
            }
        } else {
            $tbl = 'Tugas tambahan belum disetujui';
        }


        return $tbl;
    }
    public function isi()
    {

        $id = request()->input('id');
        $bul = request()->input('bul');
        $tbl = '';
        $data = target_semester::with('kinerja')->where('id_ped', $id)->where('bulan', $bul)->where(function ($q) {
            $q->where('status', '1')->orWhere('status', '2');
        })->get();
        $no = 1;
        foreach ($data as $value) {
            $totallog = t_log::where('id_target', $value->id)->get();
            $tbl .= '<tbody class="' . $this->check($value->status) . '">
            <tr>
                <th style="width:3%;" scope="row">' . $no++ . '</th>
                <th style="width:5%;">Kinerja Utama</th>
                <td class=" text-left" colspan="3">' . $value->kinerja->rencana . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <th>Rencana Kinerja</th>
                <td class="text-left" colspan="3">' . $value->kegiatan . '</td>
            </tr>
            <tr>
                <th scope="row"></th>
                <th>Keterangan</th>
                <td class="text-left" colspan="3">' . $value->ket . '</td>
            </tr>
            <tr>
            <th class="text-bold" colspan="2"><b>Aspek</b> </th>

            <td><b>Indikator Kinerja Individu </b> </td>
            <td><b>Target</b></td>
            <td><b>Realisasi </b></td>
        </tr>
        <tr>
        <th colspan="2"><b>Kuantitas</b> </th>

        <td style="width:40%">' . $value->ikikuantitas . '</td>
        <td style="width:15%">' . $value->tkuantitas . ' -' . $value->tkuantitasmax . ' ' . $value->satuan  . '</td>
        <td style="width:10%"> <div class="form-group">
        <input name="rkuantitas[]" type="number" value="' . $value->rkuantitas . '" class="form-control" >
    </div></td>
    </tr>
    <tr>
    <th colspan="2"><b>Kualitas</b> </th>

    <td style="width:40%">' . $value->ikikualitas . '</td>
    <td style="width:15%">' . $value->tkualitas . ' -' . $value->tkualitasmax . ' ' . $value->satuankualitas  . '</td>
    <td style="width:10%"> <div class="form-group">
    <input name="rkualitas[]" type="number" value="' . $value->rkualitas . '" class="form-control" >
</div></td>
</tr>
<tr>
<th colspan="2"><b>Waktu</b> </th>

<td>' . $value->ikiwaktu . '</td>
<td>' . $value->twaktu . ' -' . $value->twaktumax . ' ' . $value->satuanwaktu  . '</td>
<td style="width:20%"> <div class="form-group">
<input name="rwaktu[]" type="number" value="' . $value->rwaktu . '" class="form-control" >
</div></td>
</tr>
            <tr>
                <th colspan="2"><b>Log Harian</b> : <div class="badge badge-success" type="button" onclick="loghariani(' . $value->id . ')"> ' . $totallog->count() . '</div></th>

                <td class="text-left" colspan="3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><b>Feedback</b></label>
                        <textarea name="kr[]" placeholder="Keterangan Penilaian" class="form-control" id="exampleFormControlTextarea1" rows="1">' . $value->feedback . '</textarea>
                    </div>
                </td>
            </tr>
      
            <tr>
                <td class="" colspan="5"></td>
            </tr>
            <input name="id[]" type="hidden" value="' . $value->id . '">
            <input name="ms" type="hidden" value="' . $id . '">

        </tbody><tbody>
        <tr><td></td></tr></tbody>';
        }

        return $tbl;
    }
    public function bulan()
    {

        if (Session::has('period')) {
            $idp = Session::get('period');
            $ida = Auth::user()->id_peg;

            $id_mn = Manajemen_p::where('id_ped', $idp)->where('pp', $ida)->first() ?? "null";
            $datap = t_periode::where('id', $idp)->first();
            if ($id_mn != "null") {

                if (request()->ajax()) {
                    return datatables()->of(Manajemen_p::where('id_ped', $idp)->where('pp', $ida)->get())->addIndexColumn()->addColumn('nip', function ($data) {
                        return $data->datapegawai->nip;
                    })->addColumn('nama', function ($data) {
                        return $data->datapegawai->nama;
                    })->addColumn('jabatan', function ($data) {
                        return $data->datapegawai->jabatan;
                    })->addColumn('status_real', function ($data) {
                        $total2 = target_semester::where('status', '2')->where('id_ped', $data->id)->where('bulan', request()->input('id'))->get();
                        return $total2->count();
                    })->addColumn('status_target', function ($data) {
                        $total = target_semester::where('id_ped', $data->id)->where('bulan', request()->input('id'))->get();
                        $total2 = target_semester::whereIn('status', ['1', '2'])->where('id_ped', $data->id)->where('bulan', request()->input('id'))->get();
                        return $total2->count() . '/' . $total->count();
                    })->addColumn('nilait', function ($data)  use ($id_mn) {


                        $total = target_semester::where('id_ped', $data->id)->where('bulan', request()->input('id'))->get() ?? null;
                        $nilai = [0];
                        if ($total != null) {
                            # code...
                            foreach ($total as $value) {
                                if ($value['status'] == '2') {
                                    $nilai[] =  $value['nilai_mutu'];
                                }
                            }
                        } else {
                            $nilai = [0];
                        }
                        if ($id_mn->status_tugas == 1 || $id_mn->status_tugas == 4) {
                            $datatugas = t_tugastambahan::where('id_mn', $data->id)->where('status', '!=', '0')->get();
                            foreach ($datatugas as $valuet) {
                                if ($valuet['status'] != '0') {
                                    $nilai[] =  $valuet['nilai_mutu'];
                                }
                            }
                        }
                        if (array_sum($nilai) > 0) {
                            # code...
                            return array_sum($nilai) / (count($nilai) - 1);
                        } else {
                            return array_sum($nilai) / count($nilai);
                        }
                    })->addColumn('nilaia', function ($data) use ($id_mn) {

                        $total = target_semester::where('id_ped', $data->id)->where('bulan', request()->input('id'))->get() ?? null;
                        $nilai = [0];
                        if ($total != null) {
                            # code...
                            foreach ($total as $value) {
                                if ($value['status'] == '2') {
                                    $nilai[] =  $value['nilai_capaian'];
                                }
                            }
                        } else {
                            $nilai = [0];
                        }
                        if ($id_mn->status_tugas == 1 || $id_mn->status_tugas == 4) {
                            $datatugas = t_tugastambahan::where('id_mn', $data->id)->where('status', '!=', '0')->get();
                            foreach ($datatugas as $valuet) {
                                if ($valuet['status'] != '0') {
                                    $nilai[] =  $valuet['nilai_capaian'];
                                }
                            }
                        }
                        if (array_sum($nilai) > 0) {
                            return array_sum($nilai) / (count($nilai) - 1);
                        } else {
                            return array_sum($nilai) / count($nilai);
                        }
                    })->addColumn('aksi', function ($data) {
                        $btn = '<div class="float-right">';
                        $btn .= ' <button type="button" onclick="nilai(\'' . $data->id . '\',\'' . request()->input('id') . '\')" class="btn btn-warning btn-xs waves-effect waves-light"> SKP </button>';
                        $btn .= ' <button type="button" onclick="nilait(\'' . $data->id . '\',\'' . request()->input('id') . '\')" class="btn btn-warning btn-xs waves-effect waves-light"> Tugas Tambahan </button>';
                        // $btn .= ' <button type="button" onclick="reset(\'' . $data->id . '\',\'' . request()->input('id') . '\')" class="btn btn-primary btn-xs waves-effect waves-light"> Reset Nilai</button>';
                        $btn .= ' <button type="button" onclick="lihatlogs(\'' . $data->id . '\',\'' . request()->input('id') . '\')" class="btn btn-primary btn-xs waves-effect waves-light"> Log Harian</button>';
                        $btn .= '</div>';
                        return $btn;
                    })->rawColumns(['nip', 'nilaia', 'aksi', 'nilait', 'status_real'])->make(true);
                }
            }
        }
    }
    public function index()
    {
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
            if (request()->input('id')) {
                # code...
            }
            $idp = Session::get('period');
            $ida = Auth::user()->id_peg;
            $ids = '';
            $smst = '';
            $datap = t_periode::where('id', $idp)->first();
            if ($datap->semester == 1) {
                $smst = json_decode(json_encode($smstr1));
            }
            if ($datap->semester == 2) {
                $smst = json_decode(json_encode($smstr2));
            }
            if (request()->ajax()) {
                return datatables()->of(Manajemen_p::where('id_ped', $idp)->where('pp', $ida)->get())->addIndexColumn()->addColumn('nip', function ($data) {
                    return $data->datapegawai->nip;
                })->addColumn('nama', function ($data) {
                    return $data->datapegawai->nama;
                })->addColumn('jabatan', function ($data) {
                    return $data->datapegawai->jabatan;
                })->addColumn('aksi', function ($data) {
                    $btn = '<div class="d-flex justify-content-around">';
                    $btn .= ' <button type="button" class="btn btn-warning btn-xs waves-effect waves-light"><i class="fa fa-bars"></i> Isi Nilai </button>';
                    $btn .= ' <button type="button" class="btn btn-primary btn-xs waves-effect waves-light"><i class="fa fa-bars"></i> Reset Nilai</button>';
                    $btn .= ' <button type="button" class="btn btn-primary btn-xs waves-effect waves-light"><i class="fa fa-bars"></i> Log Harian</button>';
                    $btn .= '</div>';
                    return $btn;
                })->rawColumns(['nip', 'aksi'])->make(true);
            }
        }


        return view('user.penilaian.index', compact('datap', 'smst'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rkuantitas = request()->input('rkuantitas');
        $rkualitas = request()->input('rkualitas');
        $rwaktu = request()->input('rwaktu');
        $ket = request()->input('kr');

        $nilai = request()->input('rkualitas');
        $id = request()->input('id');
        $idm = request()->input('ms');

        $id_peg = Auth::user()->id_peg;
        $na = [];
        $nt = [];
        foreach ($id as $key => $value) {
            $arr = [];
            $d = target_semester::where('id', $id[$key])->first();

            if ($d->tkuantitas <= $rkuantitas[$key] && $d->tkuantitasmax >= $rkuantitas[$key]) {
                $nckuantitas = 100;
            } else if ($d->tkuantitas > $rkuantitas[$key]) {
                $nckuantitas = ($rkuantitas[$key] / $d->tkuantitas) * 100;
                $nckuantitas = round($nckuantitas);
            } else if ($d->tkuantitasmax < $rkuantitas[$key]) {
                $nckuantitas = ($rkuantitas[$key] / $d->tkuantitasmax) * 100;
                $nckuantitas =  round($nckuantitas);
            }

            $mink = intval($d->tkualitas);
            $maxk = intval($d->tkualitasmax);
            if ($mink <= $rkualitas[$key] && $maxk >= $rkualitas[$key]) {
                $nckualitas = 100;
            } else if ($mink > $rkualitas[$key]) {
                $nckualitas = ($rkualitas[$key] / $mink) * 100;
                $nckualitas = round($nckualitas);
            } else if ($maxk < $rkualitas[$key]) {
                $nckualitas = ($rkualitas[$key] / $maxk) * 100;
                $nckualitas =  round($nckualitas);
            }

            if ($d->twaktu <= $rwaktu[$key] && $d->twaktumax >= $rwaktu[$key]) {
                $ncwaktu = 100;
            } else if ($d->twaktu > $rwaktu[$key]) {
                $ncwaktu = 1 - ($rwaktu[$key] / $d->twaktu);
                $ncwaktu = 100 + ($ncwaktu * 100);
                $ncwaktu = round($ncwaktu);
            } else if ($d->twaktumax < $rwaktu[$key]) {
                $ncwaktu = ($rwaktu[$key] / $d->twaktumax) - 1;
                $ncwaktu = 100 - ($ncwaktu * 100);
                $ncwaktu = round($ncwaktu);
            }
            if ($nckuantitas != '0') {
                $arr[] = $nckuantitas;
            }
            if ($nckualitas != '0') {
                $arr[] = $nckualitas;
            }
            if ($ncwaktu != '0') {
                $arr[] = $ncwaktu;
            }
            $avg = ($nckualitas  + $ncwaktu  + $nckuantitas) / 3;

            if ($avg > 100) {
                $na[] =  120;
                $nt[] = (0.8 * 120) + (0.2 * 80);
            } else if ($avg > 80) {
                $na[] =  100;
                $nt[] = (0.8 * 100) + (0.2 * 80);
            } else if ($avg > 60) {
                $na[] =  80;
                $nt[] = (0.8 * 80) + (0.1 * 80);
            } else if ($avg > 25) {
                $na[] =  60;
                $nt[] = (0.8 * 60) + (0.05 * 80);
            } else {
                $na[] =  25;
                $nt[] = (0.8 * 25) + (0.01 * 80);
            }
        }
        $bulan = $d->bulan;
        switch ($bulan) {
            case "1":
                $nb = 'jan';
                break;
            case "2":
                $nb = 'feb';
                break;
            case "3":
                $nb = 'mar';
                break;
            case "4":
                $nb = 'apr';
                break;
            case "5":
                $nb = 'mei';
                break;
            case "6":
                $nb = 'jun';
                break;
            case "7":
                $nb = 'jul';
                break;
            case "8":
                $nb = 'agus';
                break;
            case "9":
                $nb = 'sep';
                break;
            case "10":
                $nb = 'okt';
                break;
            case "11":
                $nb = 'nov';
                break;
            case "12":
                $nb = 'des';
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        try {
            target_semester::upsert(collect($ket)->map(function ($v, $k) use ($id, $nt, $na, $rkuantitas, $rkualitas, $rwaktu, $nilai, $ket) {
                echo $id[$k];
                return [
                    'id' => $id[$k],
                    'nilai_atasan' => $nilai[$k],
                    'status' => "2",
                    'rwaktu' => $rwaktu[$k],
                    'rkuantitas' => $rkuantitas[$k],
                    'rkualitas' => $rkualitas[$k],
                    'nilai_capaian' => $na[$k],
                    'feedback' => $ket[$k],
                    'nilai_mutu' => $nt[$k]
                ];
            })->toArray(), ['id'], ['status', 'rwaktu', 'nilai_mutu', 'rkuantitas', 'rkualitas', 'nilai_atasan', 'nilai_capaian', 'feedback']);

            $id_ped = $d->id_ped;
            $rataskp = array_sum($nt) / count($nt);

            if (Session::get('semester') == '1') {
                $dt = t_tahunpegawai::with('bulan')->where('id_semester_1', $id_ped)->first();
            } else {
                $dt = t_tahunpegawai::with('bulan')->where('id_semester_2', $id_ped)->first();
            }
            Manajemen_p::where('id', $idm)->update(['nilai_skp' => $rataskp, 'status_target' => '4']);
            return "tolol";
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function storetugas(Request $request)
    {
        $rkuantitas = request()->input('rkuantitas');
        $rkualitas = request()->input('rkualitas');
        $rwaktu = request()->input('rwaktu');
        $ket = request()->input('kr');

        $nilai = request()->input('rkualitas');
        $id = request()->input('id');
        $idm = request()->input('ms');
        $id_peg = Auth::user()->id_peg;
        $na = [];
        $nt = [];
        foreach ($id as $key => $value) {
            $arr = [];
            $d = t_tugastambahan::where('id', $id[$key])->first();

            if ($d->tkuantitas <= $rkuantitas[$key] && $d->tkuantitasmax >= $rkuantitas[$key]) {
                $nckuantitas = 100;
            } else if ($d->tkuantitas > $rkuantitas[$key]) {
                $nckuantitas = ($rkuantitas[$key] / $d->tkuantitas) * 100;
                $nckuantitas = round($nckuantitas);
            } else if ($d->tkuantitasmax < $rkuantitas[$key]) {
                $nckuantitas = ($rkuantitas[$key] / $d->tkuantitasmax) * 100;
                $nckuantitas =  round($nckuantitas);
            }

            $mink = intval($d->tkualitas);
            $maxk = intval($d->tkualitasmax);
            if ($mink <= $rkualitas[$key] && $maxk >= $rkualitas[$key]) {
                $nckualitas = 100;
            } else if ($mink > $rkualitas[$key]) {
                $nckualitas = ($rkualitas[$key] / $mink) * 100;
                $nckualitas = round($nckualitas);
            } else if ($maxk < $rkualitas[$key]) {
                $nckualitas = ($rkualitas[$key] / $maxk) * 100;
                $nckualitas =  round($nckualitas);
            }

            if ($d->twaktu <= $rwaktu[$key] && $d->twaktumax >= $rwaktu[$key]) {
                $ncwaktu = 100;
            } else if ($d->twaktu > $rwaktu[$key]) {
                $ncwaktu = 1 - ($rwaktu[$key] / $d->twaktu);
                $ncwaktu = 100 + ($ncwaktu * 100);
                $ncwaktu = round($ncwaktu);
            } else if ($d->twaktumax < $rwaktu[$key]) {
                $ncwaktu = ($rwaktu[$key] / $d->twaktumax) - 1;
                $ncwaktu = 100 - ($ncwaktu * 100);
                $ncwaktu = round($ncwaktu);
            }
            if ($nckuantitas != '0') {
                $arr[] = $nckuantitas;
            }
            if ($nckualitas != '0') {
                $arr[] = $nckualitas;
            }
            if ($ncwaktu != '0') {
                $arr[] = $ncwaktu;
            }
            $avg = ($nckualitas  + $ncwaktu  + $nckuantitas) / 3;

            if ($avg > 100) {
                $na[] =  120;
                $nt[] = (0.8 * 120) + (0.2 * 80);
            } else if ($avg > 80) {
                $na[] =  100;
                $nt[] = (0.8 * 100) + (0.2 * 80);
            } else if ($avg > 60) {
                $na[] =  80;
                $nt[] = (0.8 * 80) + (0.1 * 80);
            } else if ($avg > 25) {
                $na[] =  60;
                $nt[] = (0.8 * 60) + (0.05 * 80);
            } else {
                $na[] =  25;
                $nt[] = (0.8 * 25) + (0.01 * 80);
            }
            $d->status = '2';
            $d->rwaktu = $rwaktu[$key];
            $d->rkuantitas = $rkuantitas[$key];
            $d->rkualitas = $rkualitas[$key];
            $d->nilai_capaian = $na[$key];
            $d->nilai_mutu = $nt[$key];
            $d->feedback = $ket[$key];
            $d->save();
        }


        try {


            $id_ped = $d->id_ped;
            $rataskp = array_sum($nt) / count($nt);
            Manajemen_p::where('id', $idm)->update(['status_tugas' => 4]);


            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
