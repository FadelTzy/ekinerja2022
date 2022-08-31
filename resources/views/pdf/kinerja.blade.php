@extends('pdf.layouts')

@section('content')
    <style>
        * {
            font-size: 15px;
        }

    </style>
    <p style="text-align: center;"><img
            src="data:image/png;base64,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"
            style="width: 56px;"><br></p>
    <h2 class="" style="text-align: center;">PENILAIAN KINERJA <br> PEGAWAI NEGERI SIPIL</h2>

    <p>{{ $periode }}</p>
    <p>UNIVERSITAS NEGERI MAKASSAR</p>
    <table>

        <tbody>

            @php $no = 1 @endphp
            @php $cek = 1 @endphp
            @foreach ($target->getData()->data as $it => $t)
                @foreach ($t->target as $i => $item)
                    <tr>
                        @php
                            if ($item->tkuantitas <= $item->rkuantitas && $item->tkuantitasmax >= $item->rkuantitas) {
                                $nckuantitas = 100;
                            } elseif ($item->tkuantitas > $item->rkuantitas) {
                                $nckuantitas = ($item->rkuantitas / $item->tkuantitas) * 100;
                                $nckuantitas = round($nckuantitas);
                            } elseif ($item->tkuantitasmax < $item->rkuantitas) {
                                $nckuantitas = ($item->rkuantitas / $item->tkuantitasmax) * 100;
                                $nckuantitas = round($nckuantitas);
                            }
                            if ($nckuantitas >= 101) {
                                $kkuan = 'Sangat Baik';
                            } elseif ($nckuantitas == 100) {
                                $kkuan = 'Baik';
                            } elseif ($nckuantitas >= 80) {
                                $kkuan = 'Cukup';
                            } elseif ($nckuantitas >= 60) {
                                $kkuan = 'Kurang';
                            } elseif ($nckuantitas >= 0) {
                                $kkuan = 'Sangat Kurang';
                            }
                            
                            $mink = intval($item->tkualitas);
                            $maxk = intval($item->tkualitasmax);
                            
                            if ($mink <= $item->rkualitas && $maxk >= $item->rkualitas) {
                                $nckualitas = 100;
                            } elseif ($mink > $item->rkualitas) {
                                $nckualitas = ($item->rkualitas / $mink) * 100;
                                $nckualitas = round($nckualitas);
                            } elseif ($maxk < $item->rkualitas) {
                                $nckualitas = ($item->rkualitas / $maxk) * 100;
                                $nckualitas = round($nckualitas);
                            }
                            if ($nckualitas >= 101) {
                                $kkual = 'Sangat Baik';
                            } elseif ($nckualitas == 100) {
                                $kkual = 'Baik';
                            } elseif ($nckualitas >= 80) {
                                $kkual = 'Cukup';
                            } elseif ($nckualitas >= 60) {
                                $kkual = 'Kurang';
                            } elseif ($nckualitas >= 0) {
                                $kkual = 'Sangat Kurang';
                            }
                            if ($item->twaktu <= $item->rwaktu && $item->twaktumax >= $item->rwaktu) {
                                $ncwaktu = 100;
                            } elseif ($item->twaktu > $item->rwaktu) {
                                $ncwaktu = 1 - $item->rwaktu / $item->twaktu;
                                $ncwaktu = 100 + $ncwaktu * 100;
                                $ncwaktu = round($ncwaktu);
                            } elseif ($item->twaktumax < $item->rwaktu) {
                                $ncwaktu = $item->rwaktu / $item->twaktumax - 1;
                                $ncwaktu = 100 - $ncwaktu * 100;
                                $ncwaktu = round($ncwaktu);
                            }
                            if ($ncwaktu >= 101) {
                                $kwaktu = 'Sangat Baik';
                            } elseif ($ncwaktu == 100) {
                                $kwaktu = 'Baik';
                            } elseif ($ncwaktu >= 80) {
                                $kwaktu = 'Cukup';
                            } elseif ($ncwaktu >= 60) {
                                $kwaktu = 'Kurang';
                            } elseif ($ncwaktu >= 0) {
                                $kwaktu = 'Sangat Kurang';
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
                            
                            $avg = round(array_sum($arr) / count($arr));
                            if ($avg > 100) {
                                $na = 120;
                                $nt = 0.8 * 120 + 0.2 * 80;
                            } elseif ($avg > 80) {
                                $na = 100;
                                $nt = 0.8 * 100 + 0.2 * 80;
                            } elseif ($avg > 60) {
                                $na = 80;
                                $nt = 0.8 * 80 + 0.1 * 80;
                            } elseif ($avg > 25) {
                                $na = 60;
                                $nt = 0.8 * 60 + 0.05 * 80;
                            } else {
                                $na = 25;
                                $nt = 0.8 * 25 + 0.01 * 80;
                            }
                            
                        @endphp



                        @php
                            $naar = [];
                            $ntar = [];
                            $naar[] = $na;
                            $ntar[] = $nt;
                            
                        @endphp
                    </tr>


                    @php $cek++ @endphp
                @endforeach
                @php $cek= 1; @endphp
            @endforeach

            {{-- <tr class="bgrow">
                <th style=" text-align:left">{{ array_sum($naar) / count($naar) }}</th>
                <th style=" text-align:left">{{ array_sum($ntar) / count($ntar) }}</th>
            </tr> --}}
        </tbody>
    </table>
    <table class="table table-bordered table-hover table-striped">

        <tbody>
            <tr class="bgrow">
                <td style="width: 1%; text-align:center">No</td>
                <td colspan="2" style="width: 50%; ">PEGAWAI YANG DINILAI</td>

            </tr>
            <tr>
                <td>1</td>
                <td style="width: 10%">Nama</td>
                <td style="width: 40%">{{ Auth::user()->nama }} </td>

            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td> {{ Auth::user()->nip }}</td>


            </tr>
            <tr>
                <td></td>

                <td>Pangkat/Gol.</td>
                <td>{{ Auth::user()->pangkat }}, {{ Auth::user()->golongan }} </td>


            </tr>
            <tr>
                <td></td>

                <td>Jabatan</td>
                <td> {{ Auth::user()->jabatan ?? $jabatan->jabatan }}</td>


            </tr>
            <tr>
                <td></td>

                <td>Unit Kerja</td>
                <td>
                    {{ Auth::user()->unit }} / Universitas Negeri Makassar
                </td>


            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%;  ">PEJABAT PENILAI KINERJA</th>
            </tr>
            <tr>
                <td>2</td>
                <td style="width: 10%">Nama</td>
                <td style="width: 40%">{{ $ap->nama }}</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td>{{ $ap->nip }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Pangkat/Gol.</td>

                <td>{{ $ap->pangkat }}, {{ $ap->golongan }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Jabatan</td>

                <td>{{ $ap->jabatan }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Unit Kerja</td>

                <td>
                    {{ $ap->unit }} / Universitas Negeri Makassar
                </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">ATASAN PEJABAT PENILAI KINERJA
                </th>
            </tr>
            <tr>
                <td>3</td>
                <td style="width: 10%">Nama</td>
                <td style="width: 40%">{{ $pa->nama }}</td>
            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td>{{ $pa->nip }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Pangkat/Gol.</td>

                <td>{{ $pa->pangkat }}, {{ $pa->golongan }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Jabatan</td>

                <td>{{ $pa->jabatan }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Unit Kerja</td>

                <td>
                    {{ $pa->unit }} / Universitas Negeri Makassar
                </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">PENILAIAN KINERJA
                </th>
            </tr>
            @php $skp =array_sum($ntar) / count($ntar) @endphp
            <tr>
                <td>4</td>
                <td style="width: 10%">Nilai SKP</td>
                <td style="width: 40%">{{ $dataa->nilai_skp }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Nilai Perilaku Kerja</td>
                <td>{{ $dataa->nilai_perilaku }}</td>
            </tr>
            <tr>
                <td></td>

                <td>Ide Baru</td>

                <td>0</td>
            </tr>
            <tr>
                <td></td>

                <td>Nilai Kinerja Pegawai</td>
                @php $tk = ($dataa->nilai_skp + $dataa->nilai_perilaku) / 2 @endphp
                <td>{{ $tk }}</td>
            </tr>
            <tr>

                <td></td>

                <td>Predikat Kinerja Pegawai</td>

                <td>
                    @php
                        if ($tk >= 110) {
                            $tkwa = 'Sangat Baik';
                        } elseif ($tk >= 90) {
                            $tkwa = 'Baik';
                        } elseif ($tk >= 70) {
                            $tkwa = 'Cukup';
                        } elseif ($tk >= 50) {
                            $tkwa = 'Kurang';
                        } elseif ($tk >= 0) {
                            $tkwa = 'Sangat Kurang';
                        }
                    echo '( ' . $tkwa . ' )'; @endphp
                </td>
            </tr>
            <tr>
                <td></td>

                <td>Total Angka Kredit</td>

                <td>
                    -
                </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">Permasalahan
                </th>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="2" style="width: 10% height:200px"><br><br><br> </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">Rekomendasi
                </th>
            </tr>
            <tr>
                <td>6</td>
                <td colspan="2" style="width: 10% height:200px"><br><br><br> </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">Keberatan
                </th>
            </tr>
            <tr>
                <td>7</td>
                <td colspan="2" style="width: 10% height:200px"><br><br><br> </td>
            </tr>

            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">Penjelasan Pejabat Penilai Atas Keberatan
                </th>
            </tr>
            <tr>
                <td>8</td>
                <td colspan="2" style="width: 10% height:200px"><br><br><br> </td>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" style="width: 50%; ">Keputusan Atasan Pejabat Penilai Kinerja
                </th>
            </tr>
            <tr>
                <td>9</td>
                <td colspan="2" style="width: 10% height:200px"><br><br><br> </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%;" class="">
        <thead>
            <tr>
                <td style="width: 80%; border: 0px">
                    <p>Makassar, ....../....../..........</p>
                    <p>Pejabat Penilai Kinerja,</p>
                    <br><br><br>
                    <p><u> {{ Auth::user()->nama }}</u></p>

                    <p>NIP. {{ Auth::user()->nip }} </p>

                </td>
                <td style="width:20%;border: 0px">
                    <p>Makassar, ....../....../..........</p>
                    <p>Pegawai Yang Dinilai,</p>
                    <br><br><br>
                    <p><u> {{ $ap->nama }}</u></p>

                    <p>NIP. {{ $ap->nip }} </p>
                </td>
            </tr>
            <tr style="display: flex">
                <td style="width: 40%; border: 0px"></td>
                <td style="width: 30%; border: 0px">
                    <p>Makassar, ....../....../..........</p>
                    <p>Atasan Pejabat Penilai Kinerja,</p>
                    <br><br><br>
                    <p><u> {{ $pa->nama }}</u></p>

                    <p>NIP. {{ $pa->nip }} </p>

                </td>
                <td style="width: 40%; border: 0px"></td>

            </tr>
        </thead>
    </table>

    {{-- <tr class="borderless">
        <td colspan="5">
            <p>Pejabat Penilai,</p>
            <br><br><br>
            <p><u> {{ $ap->nama }}</u></p>

            <p>NIP. {{ $ap->nip }}</p>

        </td>
        <td colspan="3">
            <p>Makassar, {{ $tanggal }}</p>
            <p>PNS Yang Dinilai,</p>
            <br><br><br>
            <p><u> {{ Auth::user()->nama }}</u></p>

            <p>NIP. {{ Auth::user()->nip }}</p>
        </td>
    </tr> --}}
@endsection
