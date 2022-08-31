<?php

namespace App\Http\Controllers;

use App\Models\t_perilaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Manajemen_p;
use App\Models\t_periode;
use Illuminate\Support\Facades\Auth;
use App\Models\t_tahunpegawai;
use App\Models\target_semester;
use App\Models\t_tugastambahan;

class TPerilakuController extends Controller
{
    public $nyimpan = [];
    public function konvert($nilai, $max, $min)
    {
        if ($nilai <= $max && $nilai >= $min) {
            $nilaip = 90 + (109 - 90) * ($nilai - $min);
            $this->nyimpan[] = $nilaip;
            return $nilaip;
        }
        if ($nilai < $min) {
            $nilaip = ($nilai / $min) * 90;
            $this->nyimpan[] = $nilaip;

            return $nilaip;
        }
        if ($nilai > $max) {
            $nilaip = 190 +  ((120 - 109) / ($max - $min)) * ($nilai - $max);
            $this->nyimpan[] = $nilaip;

            return $nilaip;
        }
    }
    public function kriteria2($nil)
    {
        if ($nil >= 110 && $nil <= 120) {
            return 'Sangat Baik';
        } elseif ($nil >= 90 && $nil <= 109) {
            return 'Baik';
        } elseif ($nil >= 70 && $nil <= 89) {
            return 'Cukup';
        } elseif ($nil >= 50 && $nil <= 69) {
            return 'Kurang';
        } elseif ($nil >= 1 && $nil < 50) {
            return 'Sangat Buruk';
        } else {
            return '-';
        }
    }
    public function kriteria($nil)
    {
        if ($nil >= 91 && $nil <= 100) {
            return 'Sangat Baik';
        } elseif ($nil >= 76 && $nil <= 90) {
            return 'Baik';
        } elseif ($nil >= 61 && $nil <= 75) {
            return 'Cukup';
        } elseif ($nil >= 51 && $nil <= 60) {
            return 'Kurang';
        } elseif ($nil >= 1 && $nil <= 50) {
            return 'Sangat Buruk';
        } else {
            return '-';
        }
    }
    public function konversi($nil)
    {
        if ($nil > 90 && $nil <= 99) {
            $nilai = 110 + (((120 - 110) / (99 - 91)) * ($nil - 91));
            return $nilai;
        } elseif ($nil > 75 && $nil <= 90) {
            $nilai = 90 + (((109 - 90) / (90 - 76)) * ($nil - 76));
            return $nilai;
        } elseif ($nil > 60 && $nil <= 75) {
            $nilai = 70 + (((89 - 70) / (75 - 61)) * ($nil - 61));
            return $nilai;
        } elseif ($nil > 50 && $nil <= 60) {
            $nilai = 50 + (((69 - 50) / (60 - 51)) * ($nil - 51));
            return $nilai;
        } elseif ($nil <= 50) {
            $nilai = ($nil / 50) * 49;
            return $nilai;
        } else {
            return '120';
        }
    }
    public function integrasinilai()
    {
        try {
            $data = request()->input('id');
            $tahun =  Session::get('tahon');
            $data = t_tahunpegawai::where('id_peg', $data['id_peg'])->where('tahun', $tahun)->update([
                'status_1' => $data['nilaip1k'],
                'status_2' => $data['nilaip2k'],
                'nilai' => $data['total'],
                'predikat' => $data['predikat'],
                'tanggalnilai' => date('d M Y')
            ]);
            if ($data) {
                # code...
                return 'success';
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function integrasi()
    {
        $tahun =  Session::get('tahon');
        $ida = request()->input('id');
        $data = t_tahunpegawai::where('id_peg', $ida)->where('tahun', $tahun)->first();
        $m1 = Manajemen_p::select('nilai_skp', 'nilai_kerja')->where('id', $data->id_semester_1)->first();
        $m2 = Manajemen_p::select('nilai_skp', 'nilai_kerja')->where('id', $data->id_semester_2)->first();
        $data['nilaip1'] = number_format($m1->nilai_skp * 0.6 + $m1->nilai_kerja * 0.4, 2, '.');
        $data['nilaip2'] =  number_format($m2->nilai_skp * 0.6 + $m2->nilai_kerja * 0.4, 2, '.') + 2;
        $data['nilaip1k'] = number_format($this->konversi($data['nilaip1']), 2, '.');
        $data['nilaip2k'] = $data['nilaip2'];
        $data['total'] =  $data['nilaip1k'] * 0.5 + $data['nilaip2k'] * 0.5;
        $data['predikat'] = $this->kriteria2($data['total']);
        $btn = '   <table class="table table-bordered table-hover table-striped">
        <tbody>
        <tr>
        <td colspan="1" style="width: 350px;"><b>Tanggal Intergasi Penilaian</b></td>
        <td colspan="2" class="" style="width: 200px;">
            <b>' . $data->tanggalnilai . '</b>
        </td>

    </tr>
            <tr>
                <td colspan="1" style="width: 350px;"><b>Periode</b></td>
                <td colspan="1" class="text-center" style="width: 200px;">
                    <b> Nilai Prestasi</b>
                </td>
                <td colspan="1" class="text-center" style="width: 200px;"> <b> Nilai Konversi</b> </td>

            </tr>
            <tr>
                <td style="width: 350px;">JANUARI - JUNI</td>
                <td style="width: 200px;" class="text-center">
' . $data['nilaip1'] . '
                </td>
                <td>' . $data['nilaip1k'] . '</td>
            </tr>
            <tr>
                <td>JULI - DESEMBER</td>
                <td class="text-center">
' . $data['nilaip2'] . '
                </td>
                <td>' . $data['nilaip2k'] . '</td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Nilai Kinerja PNS Tahun ' . Session::get("tahon") . '</strong>
                </td>
                <td><strong> ' .  $data['total'] . '</strong></td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Predikat</strong>
                </td>
                <td><strong>' . $data['predikat'] . '</strong></td>
            </tr>
        </tbody>
    </table>';
        $btn .= "<div class='float-right' id=''>
        <button onclick='integr(" . $data .  ")'  type='button' class='btn btn-sm btn-info waves-effect waves-light' data-toggle='modal' data-target='#dbp'>Integrasi</button>
</div>";

        return $btn;
    }
    public function reset()
    {
        $id = request()->input('id');

        $data = Manajemen_p::where('id', $id)->update(['nilai_kerja' => '0']);
        $perilaku = t_perilaku::where('id_m', $id)->update([
            'orientasi_pelayanan' => '0',
            'komitmen' => '0',
            'disiplin' => '0',
            'kerjasama' => '0',
            'kepemimpinan' => '0',
            'inisiatif_kerja' => '0',
            'integritas' => '0',
            'status' => '0',
            'created_at' => null
        ]);
        return $data;
    }
    public function check()
    {
        $data = request()->input('data');
        $nilaiskp = request()->input('nilai');
        $jenjang = request()->input('jenjang');
        $np = request()->input('np');
        $idm = request()->input('idm');
        $max = $jenjang['level_max'];
        $min = $jenjang['level_min'];

        $aspek[] = $data['orientasi_pelayanan'];
        $aspek[] = $data['komitmen'];
        $aspek[] = $data['kerjasama'];
        $aspek[] = $data['kepemimpinan'];
        $aspek[] = $data['inisiatif_kerja'];

        $nilaiskp = $nilaiskp ?? 0;
        $kali60 = $nilaiskp * 0.6;

        if (Session::get('semester') == '1') {
            $aspek[] = $data['integritas'];
            $aspek[] = $data['disiplin'];
            foreach ($aspek as $key) {
                if ($key != '0') {
                    $jumlah[] = $key;
                }
            }
            $rpk = (array_sum($aspek) / count($jumlah)) * 0.4;

            $tabel = '<table class="table w-100 table-bordered table-hover">
            <tbody>
                <tr style="width: 100%;">
                <td style="width: 1%;">No</td>
                    <td colspan="4">Aspek Perilaku</td>
                    <td>Level</td>
                    <td>Nilai</td>
                </tr>
                <tr>
                <td >1.  </td>
                <td colspan="4" >Orientasi Pelayanan</td>
                <td>' . $data['orientasi_pelayanan'] . '</td>
                <td>' . $this->konvert($data['orientasi_pelayanan'], $max, $min)  . '</td>

            </tr>
            <tr>
              <td >2.  </td>
                 <td colspan="4" >Inisiatif Kerja</td>
            <td>' . $data['inisiatif_kerja'] . '</td>
            <td>' . $this->konvert($data['inisiatif_kerja'], $max, $min) . '</td>

        </tr>
        <tr>
        <td >3.  </td>
        <td colspan="4" >Komitmen</td>
        <td>' . $data['komitmen'] . '</td>
        <td>' . $this->konvert($data['komitmen'], $max, $min) . '</td>

    </tr>
    <tr>
    <td >4.  </td>
    <td colspan="4" >Kerjasama</td>
    <td>' . $data['kerjasama'] . '</td>
    <td>' . $this->konvert($data['kerjasama'], $max, $min) . '</td>

</tr>
<tr>
<td colspan="6" >Nilai Rata - Rata</td>
<td>' . array_sum($this->nyimpan) / 4 . '</td>

</tr>    
            </tbody>
        </table>';
            $arr = array_sum($this->nyimpan) / 4;
            $total = ($arr + $nilaiskp) / 2;
            $tabel .= '<table class="table w-100 table-bordered table-hover">
        <tbody>
          
     
   

<tr>
<td style="width:80%" >Nilai SKP</td>
<td>' . $nilaiskp . '</td>

</tr>  
<tr>
<td  >Nilai Perilaku Kerja</td>
<td>' .  $arr . '</td>

</tr>     
<tr>
<td  >Nilai Kinerja Pegawai</td>
<td>' .  $total  . ' (' . $this->kriteria2($total) . ')' . '</td>

</tr>     

        </tbody>
    </table>';

            $tabel .= "<button onclick='savenilai(" . $arr .  "," . $idm . "," . $nilaiskp . ")' class='btn btn-sm btn-primary'> Simpan </button>";
        } elseif (Session::get('semester') == '2') {
            $aspek[] = $data['integritas'];
            $aspek[] = $data['disiplin'];
            foreach ($aspek as $key) {
                if ($key != '0') {
                    $jumlah[] = $key;
                }
            }
            $rpk = (array_sum($aspek) / count($jumlah)) * 0.4;

            $tabel = '<table class="table w-100 table-bordered table-hover">
            <tbody>
                <tr style="width: 100%;">
                <td style="width: 1%;">No</td>
                    <td colspan="4">Aspek Perilaku</td>
                    <td>Level</td>
                    <td>Nilai</td>
                </tr>
                <tr>
                <td >1.  </td>
                <td colspan="4" >Orientasi Pelayanan</td>
                <td>' . $data['orientasi_pelayanan'] . '</td>
                <td>' . $this->konvert($data['orientasi_pelayanan'], $max, $min)  . '</td>

            </tr>
            <tr>
              <td >2.  </td>
                 <td colspan="4" >Inisiatif Kerja</td>
            <td>' . $data['inisiatif_kerja'] . '</td>
            <td>' . $this->konvert($data['inisiatif_kerja'], $max, $min) . '</td>

        </tr>
        <tr>
        <td >3.  </td>
        <td colspan="4" >Komitmen</td>
        <td>' . $data['komitmen'] . '</td>
        <td>' . $this->konvert($data['komitmen'], $max, $min) . '</td>

    </tr>
    <tr>
    <td >4.  </td>
    <td colspan="4" >Kerjasama</td>
    <td>' . $data['kerjasama'] . '</td>
    <td>' . $this->konvert($data['kerjasama'], $max, $min) . '</td>

</tr>
<tr>
<td colspan="6" >Nilai Rata - Rata</td>
<td>' . array_sum($this->nyimpan) / 4 . '</td>

</tr>    
            </tbody>
        </table>';
            $arr = array_sum($this->nyimpan) / 4;
            $total = ($arr + $nilaiskp) / 2;
            $tabel .= '<table class="table w-100 table-bordered table-hover">
    <tbody>
      
 


<tr>
<td style="width:80%" >Nilai SKP</td>
<td>' . $nilaiskp . '</td>

</tr>  
<tr>
<td  >Nilai Perilaku Kerja</td>
<td>' .  $arr . '</td>

</tr>     
<tr>
<td  >Nilai Kinerja Pegawai</td>
<td>' .  $total  . ' (' . $this->kriteria2($total) . ')' . '</td>

</tr>     

    </tbody>
</table>';

            $tabel .= "<button onclick='savenilai(" . $arr .  "," . $idm . "," . $nilaiskp . ")' class='btn btn-sm btn-primary'> Simpan </button>";
        }


        return ($tabel);
    }
    public function savenilaip()
    {
        $np = request()->input('np');
        $id = request()->input('id');
        $ns = request()->input('nilai');

        Manajemen_p::where('id', $id)->update(['nilai_perilaku' => $np, 'nilai_skp' => $ns, 'status_penilaian' => 1]);

        return 'success';
    }
    public function sms1()
    {
        $aspek[] = request()->input('orientasi');
        $aspek[] = request()->input('komitmen');
        $aspek[] = request()->input('kerja');
        $aspek[] = request()->input('kepemimpinan');
        $aspek[] = request()->input('inisiatif');

        $d_perilaku = t_perilaku::select('id_m')->where('id', request()->input('idp'))->first();
        if (Session::get('semester') == '1') {
            $aspek[] = request()->input('integritas');
            $aspek[] = request()->input('disiplin');
            t_perilaku::where('id', request()->input('idp'))->update([
                'orientasi_pelayanan' => $aspek[0],
                'komitmen' => $aspek[1],
                'kerjasama' => $aspek[2],
                'kepemimpinan' => $aspek[3],
                'inisiatif_kerja' => $aspek[4],
                'integritas' => $aspek[5],
                'disiplin' => $aspek[6],
                'status' => '1',
                'created_at' => date('Y-m-d')
            ]);
        } else if (Session::get('semester') == '2') {
            $aspek[] = request()->input('inisiatif');
            t_perilaku::where('id', request()->input('idp'))->update([
                'orientasi_pelayanan' => $aspek[0],
                'komitmen' => $aspek[1],
                'kerjasama' => $aspek[2],
                'kepemimpinan' => $aspek[3],
                'inisiatif_kerja' => $aspek[4],
                'status' => '1',
                'created_at' => date('Y-m-d')


            ]);
        }
        $sum = array_sum($aspek);

        foreach ($aspek as $key) {
            if ($key != '0') {
                $jumlah[] = $key;
            }
        }
        $total = $sum / count($jumlah);
        Manajemen_p::where('id', $d_perilaku->id_m)->update(['nilai_kerja' => $total]);



        return 'success';
    }
    /**
     * Display a listing of the resource.
     * 0 baru set
     * 1 telah dinilai
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('period')) {
            $idp = Session::get('period');
            $semester = t_periode::select('semester')->where('id', $idp)->first();
            if (request()->ajax()) {
                return datatables()->of(Manajemen_p::with('perilaku', 'jenjang.jabatan')->where(function ($query) use ($idp) {
                    $query->where('pp', Auth::user()->id_peg)->where('id_ped', $idp);
                })->get())->addIndexColumn()->addColumn('nip', function ($data) {
                    return $data->datapegawai->nip;
                })->addColumn('nama', function ($data) {
                    return $data->datapegawai->nama;
                })->addColumn('aksi', function ($data) {

                    $total = target_semester::where('id_ped', $data->id)->get() ?? null;
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
                    if ($data->status_tugas == 1 || $data->status_tugas == 4) {
                        $datatugas = t_tugastambahan::where('id_mn', $data->id)->where('status', '!=', '0')->get();
                        foreach ($datatugas as $valuet) {
                            if ($valuet['status'] != '0') {
                                $nilai[] =  $valuet['nilai_mutu'];
                            }
                        }
                    }
                    if (array_sum($nilai) > 0) {
                        # code...
                        $tot =  array_sum($nilai) / (count($nilai) - 1);
                    } else {
                        $tot =  array_sum($nilai) / count($nilai);
                    }

                    $nilaiskp = round($tot, 2);
                    $idj = $data->id_jenjang;
                    $id = $data->perilaku ?? '0';
                    $nilai = $data->nilai_skp ?? '0';
                    if ($data->status_target == 0) {
                        return "<b class='text-danger text-small'>Belum Diset</b>";
                    } else {
                        $btn = '<ul class="list-inline table-action m-0">';
                        $btn .= "<li class='list-inline-item'>
                        <a href='javascript:void(0);' data-toggle='modal' data-target='#con-close-modal' onclick='nilai(" . json_encode($id) . "," . $data->id . "," . $data->jenjang . ")' class='action-icon'> <i class='fa fas fa-edit'></i></a>
                    </li>";

                        $btn .= '<li class="list-inline-item">
                            <a href="javascript:void(0);" onclick="reset(' . $data->id . ')" class="action-icon"> <i class="fa fas fa-undo"></i></a>
                        </li>';
                        $btn .= "<li class='list-inline-item'>
                        <a href='javascript:void(0);' data-toggle='modal' data-target='#check' onclick='check(" . json_encode($id) .  "," . $nilaiskp . "," . json_encode($data->jenjang) . "," . $data->nilai_skp . "," . $data->id . ")' class='action-icon'> <i class='fa fas fa-list'></i></a>
                    </li>";
                        if (Session::get('semester') == '2') {
                            $btn .= "<li class='list-inline-item'>
                            <a href='javascript:void(0);' data-toggle='modal' data-target='#integrasi' onclick='integrasi(" . $data->id_peg . ")' class='action-icon'> <i class='far fa-window-restore'></i></a>
                        </li>";
                        }

                        return $btn;
                    }
                })->addColumn('jabatan', function ($data) {
                    return $data->datapegawai->jabatan;
                })->addColumn('period', function ($data) {
                    return $data->periode->status_bulan;
                })->addColumn('status', function ($data) {

                    if ($data->perilaku != null) {
                        if ($data->perilaku->status == '1') {
                            return "<b class='badge badge-info text-small'>Telah Dinilai</b>";
                        } else {
                            return "<b class='badge badge-warning text-small'>Menunggu Penilaian</b>";
                        }
                    }
                    if ($data->status_target == 0) {
                        return "<b class='badge badge-danger text-small'>Belum Diset</b>";
                    } elseif ($data->status_target == 1) {
                        return "<b class='badge badge-warning text-small'>Menunggu Penilaian</b>";
                    }
                })->rawColumns(['aksi', 'status', 'nip', 'status', 'jabatan', 'period'])->make(true);
            }
        }
        if ($semester->semester == '2') {
            $form = '<form action=""  id="sms1"  method="post">
            <input type="hidden" name="idp" id="idp">
            <div class="modal-body p-2">
            <div class="row mb-2">
            <div class="col-6">
                <div class="float-left" id="btnpegawai">
                <button type="button" class="btn btn-sm btn-info waves-effect waves-light" data-toggle="modal" data-target="#bp">Data Pegawai</button>
                </div>

            </div>
            <div class="col-6 d-flex justify-content-end">
         
                <div class="float-right" >
                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light" data-toggle="modal" data-target="#kriteria">Kriteria Penilaian</button>

                </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Orientasi Pelayanan</label>
                            <input type="number" max="100" min="0" value="0" required class="form-control" name="orientasi" id="orientasi">
                           
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Komitmen</label>
                            <input type="number" max="100" min="0" value="0" required class="form-control" name="komitmen" id="komitmen">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Inisiatif Kerja</label>
                            <input type="number" max="100" min="0" value="0" required class="form-control" name="inisiatif" id="inisiatif">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Kerja Sama</label>
                            <input type="number" max="100" min="0" value="0" required class="form-control" name="kerja" id="kerja">
                        </div>
                    </div>
             
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" id="btnsms1" class="btn btn-info waves-effect waves-light">Simpan</button>
            </div>
        </form>';
        } else if ($semester->semester == '1') {
            $form = '<form action=""  id="sms1"  method="post">
            <input type="hidden" name="idp" id="idp">
            <div class="modal-body p-2">
            <div class="row mb-2">
     
            <div class="col-12 d-flex justify-content-end">
         
                <div class="float-right" >
               

                </div>
            </div>
        </div>
   
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Orientasi Pelayanan</label>
                            <div class="input-group input-group-merge" >
                            <input type="number" max="100" min="0" value="0" required class="form-control" name="orientasi" id="orientasi">
                            <div type="button" data-toggle="modal" data-target="#kriteria" class="input-group-text btn btn-warning" >
                            <b> SP</b>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Komitmen</label>
                            <div class="input-group input-group-merge" >

                            <input type="number" max="100" min="0" value="0" required class="form-control" name="komitmen" id="komitmen">
                            <div type="button" data-toggle="modal" data-target="#kkomitmen" class="input-group-text btn btn-warning" >
                            <b> SP</b>
                            </div>
                        </div>
                                                </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Inisiatif Kerja</label>
                            <div class="input-group input-group-merge" >

                            <input type="number" max="100" min="0" value="0" required class="form-control" name="inisiatif" id="inisiatif">
                            <div type="button" data-toggle="modal" data-target="#kinisiatif" class="input-group-text btn btn-warning" >
                            <b> SP</b>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Kerja Sama</label>
                            <div class="input-group input-group-merge" >

                            <input type="number" max="100" min="0" value="0" required class="form-control" name="kerja" id="kerja">
                            <div type="button" data-toggle="modal" data-target="#kkerjasama" class="input-group-text btn btn-warning" >
                            <b> SP</b>
                            </div>
                        </div>
                        </div>
                    </div>
             
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" id="btnsms1" class="btn btn-info waves-effect waves-light">Simpan</button>
            </div>
        </form>';
        }
        return view('user.perilaku.penilaian', compact('form'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\t_perilaku  $t_perilaku
     * @return \Illuminate\Http\Response
     */
    public function show(t_perilaku $t_perilaku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\t_perilaku  $t_perilaku
     * @return \Illuminate\Http\Response
     */
    public function edit(t_perilaku $t_perilaku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\t_perilaku  $t_perilaku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, t_perilaku $t_perilaku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\t_perilaku  $t_perilaku
     * @return \Illuminate\Http\Response
     */
    public function destroy(t_perilaku $t_perilaku)
    {
        //
    }
}
