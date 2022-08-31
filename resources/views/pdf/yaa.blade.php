@extends('pdf.layouts')

@section('content')
    <h2 class="" style="text-align: center;">PENILAIAN SKP</h2>

    <p>{{ $periode }}</p>

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" class="text-center" style="width: 50%; text-align:center">PEGAWAI YANG DINILAI</th>
                <th style="width: 1%; text-align:center">No</th>
                <th colspan="2" class="text-center" style="width: 50%;  text-align:center">PEJABAT PENILAI KINERJA</th>
            </tr>

        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td style="width: 10%">Nama</td>
                <td style="width: 40%">{{ Auth::user()->nama }} </td>
                <td>1</td>
                <td style="width: 10%">Nama</td>
                <td style="width: 40%">{{ $ap->nama }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>NIP</td>
                <td> {{ Auth::user()->nip }}</td>
                <td>2</td>
                <td>NIP</td>
                <td>{{ $ap->nip }}</td>

            </tr>
            <tr>
                <td>3</td>

                <td>Pangkat/Gol.</td>
                <td>{{ Auth::user()->pangkat }}, {{ Auth::user()->golongan }} </td>
                <td>3</td>

                <td>Pangkat/Gol.</td>

                <td>{{ $ap->pangkat }}, {{ $ap->golongan }}</td>

            </tr>
            <tr>
                <td>4</td>

                <td>Jabatan</td>
                <td> {{ Auth::user()->jabatan ?? $jabatan->jabatan }}</td>
                <td>4</td>

                <td>Jabatan</td>

                <td>{{ $ap->jabatan }}</td>

            </tr>
            <tr>
                <td>5</td>

                <td>Unit Kerja</td>
                <td>
                    {{ Auth::user()->unit }} / Universitas Negeri Makassar
                </td>
                <td>5</td>

                <td>Unit Kerja</td>

                <td>
                    {{ $ap->unit }} / Universitas Negeri Makassar
                </td>

            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">No</th>
                <th class="text-center" style="width: 15%; text-align:center">Rencana Kinerja
                </th>
                <th class="text-center" style="width: 15%; text-align:center">Rencana Kinerja
                </th>
                <th class="text-center" style="width: 3%; text-align:center">Aspek
                </th>
                <th class="text-center" style="width: 15%; text-align:center">Indikator Kinerja Individu
                </th>
                <th colspan="3" class="text-center" style="width: 7%; text-align:center">Target
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Keterangan
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Realisasi
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Capaian IKI
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Kategori Capaian IKI
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Nilai Akhir
                </th>
                <th class="text-center" style="width: 5%; text-align:center">Nilai Tertimbang
                </th>
            </tr>
            <tr class="bgrow">
                <th style="width: 1%; text-align:center">(1)</th>
                <th class="text-center" style="width: 10%; text-align:center">(2)
                </th>
                <th class="text-center" style="width: 15%; text-align:center">(3)
                </th>
                <th class="text-center" style="width: 3%; text-align:center">(4)
                </th>
                <th class="text-center" style="width: 10%; text-align:center">(5)
                </th>
                <th colspan="3" class="text-center" style="width: 10%; text-align:center">(6)
                </th>
                <th class="text-center" style="width: 5%; text-align:center">(7)
                </th>
                <th class="text-center" style="width: 5%; text-align:center">(8)
                </th>
                <th class="text-center" style="width: 10%; text-align:center">(9)
                </th>
                <th class="text-center" style="width: 5%; text-align:center">(10)
                </th>
                <th class="text-center" style="width: 5%; text-align:center">(11)
                </th>
                <th class="text-center" style="width: 5%; text-align:center">(12)
                </th>
            </tr>
            <tr class="bgrow">
                <th colspan="5" style=" text-align:left">A. KINERJA UTAMA</th>
                <th style=" text-align:left">MIN</th>
                <th style=" text-align:left">-</th>
                <th style=" text-align:left">MAX</th>
                <th colspan="4" style=" text-align:left"></th>
                <th colspan="2" style=" text-align:center">CAPAIAN RENCANA KINERJA</th>

            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $naar = [];
                $ntar = [];
            @endphp ?>
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
                        <td>{{ $no++ }}</td>
                        @if ($cek == 1)
                            <td style="vertical-align:top"
                                @if ($cek == 1) rowspan="{{ 3 * count($t->target) }}" @endif>
                                {{ $t->rencana }}

                            </td>
                        @endif


                        <td rowspan="3">{{ $item->kegiatan }}</td>
                        <td>Kuantitas</td>
                        <td>{{ $item->ikikuantitas }} </td>
                        <td>{{ $item->tkuantitas }}</td>
                        <td>-</td>
                        <td>{{ $item->tkuantitasmax }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->rkuantitas }}</td>
                        <td>{{ $nckuantitas }}</td>
                        <td>{{ $kkuan }}</td>
                        <td style="text-align: center" rowspan="3">{{ $item->nilai_capaian }}</td>
                        <td style="text-align: center" rowspan="3">{{ $item->nilai_mutu }}</td>
                        @php
                            
                            $naar[] = $item->nilai_capaian;
                            $ntar[] = $item->nilai_mutu;
                            
                        @endphp
                    </tr>

                    <tr>

                        <td></td>
                        <td>Kualitas</td>
                        <td>{{ $item->ikikualitas }}</td>
                        <td>{{ $item->tkualitas }}</td>
                        <td>-</td>
                        <td>{{ $item->tkualitasmax }}</td>
                        <td>{{ $item->satuankualitas }}</td>
                        <td>{{ $item->rkualitas }}</td>
                        <td>{{ $nckualitas }}</td>
                        <td>{{ $kkual }}</td>

                    </tr>
                    <tr>

                        <td></td>
                        <td>Waktu</td>
                        <td>{{ $item->ikiwaktu }}</td>
                        <td>{{ $item->twaktu }}</td>
                        <td>-</td>
                        <td>{{ $item->twaktumax }}</td>
                        <td>{{ $item->satuanwaktu }}</td>
                        <td>{{ $item->rwaktu }}</td>
                        <td>{{ $ncwaktu }}</td>
                        <td>{{ $kwaktu }}</td>

                    </tr>

                    @php $cek++ @endphp
                @endforeach
                @php $cek= 1; @endphp
            @endforeach
            @if ($tugas != null)
                <tr class="bgrow">
                    <th colspan="5" style=" text-align:left">B. TUGAS TAMBAHAN</th>
                    <th style=" text-align:left">MIN</th>
                    <th style=" text-align:left">-</th>
                    <th style=" text-align:left">MAX</th>
                    <th colspan="4" style=" text-align:left"></th>
                    <th colspan="2" style=" text-align:center">CAPAIAN RENCANA KINERJA</th>

                </tr>
                @php $nob = 1 @endphp
                @php $cekb = 1 @endphp
                @foreach ($tugas->getData()->data as $it => $t)
                    @php
                        if ($t->tkuantitas <= $t->rkuantitas && $t->tkuantitasmax >= $t->rkuantitas) {
                            $nckuantitast = 100;
                        } elseif ($t->tkuantitas > $t->rkuantitas) {
                            $nckuantitast = ($t->rkuantitas / $t->tkuantitas) * 100;
                            $nckuantitast = round($nckuantitast);
                        } elseif ($t->tkuantitasmax < $t->rkuantitas) {
                            $nckuantitast = ($t->rkuantitas / $t->tkuantitasmax) * 100;
                            $nckuantitast = round($nckuantitast);
                        }
                        if ($nckuantitast >= 101) {
                            $kkuant = 'Sangat Baik';
                        } elseif ($nckuantitast == 100) {
                            $kkuant = 'Baik';
                        } elseif ($nckuantitast >= 80) {
                            $kkuant = 'Cukup';
                        } elseif ($nckuantitast >= 60) {
                            $kkuant = 'Kurang';
                        } elseif ($nckuantitast >= 0) {
                            $kkuant = 'Sangat Kurang';
                        }
                        
                        $minkt = intval($t->tkualitas);
                        $maxkt = intval($t->tkualitasmax);
                        
                        if ($minkt <= $t->rkualitas && $maxkt >= $t->rkualitas) {
                            $nckualitast = 100;
                        } elseif ($minkt > $t->rkualitas) {
                            $nckualitast = ($t->rkualitas / $minkt) * 100;
                            $nckualitast = round($nckualitast);
                        } elseif ($maxkt < $t->rkualitas) {
                            $nckualitast = ($t->rkualitas / $maxkt) * 100;
                            $nckualitast = round($nckualitast);
                        }
                        if ($nckualitast >= 101) {
                            $kkualt = 'Sangat Baik';
                        } elseif ($nckualitast == 100) {
                            $kkualt = 'Baik';
                        } elseif ($nckualitast >= 80) {
                            $kkualt = 'Cukup';
                        } elseif ($nckualitast >= 60) {
                            $kkualt = 'Kurang';
                        } elseif ($nckualitast >= 0) {
                            $kkualt = 'Sangat Kurang';
                        }
                        if ($t->twaktu <= $t->rwaktu && $t->twaktumax >= $t->rwaktu) {
                            $ncwaktut = 100;
                        } elseif ($t->twaktu > $t->rwaktu) {
                            $ncwaktut = 1 - $t->rwaktu / $t->twaktu;
                            $ncwaktut = 100 + $ncwaktut * 100;
                            $ncwaktut = round($ncwaktut);
                        } elseif ($t->twaktumax < $t->rwaktu) {
                            $ncwaktut = $t->rwaktu / $t->twaktumax - 1;
                            $ncwaktut = 100 - $ncwaktut * 100;
                            $ncwaktut = round($ncwaktut);
                        }
                        if ($ncwaktut >= 101) {
                            $kwaktut = 'Sangat Baik';
                        } elseif ($ncwaktut == 100) {
                            $kwaktut = 'Baik';
                        } elseif ($ncwaktut >= 80) {
                            $kwaktut = 'Cukup';
                        } elseif ($ncwaktut >= 60) {
                            $kwaktut = 'Kurang';
                        } elseif ($ncwaktut >= 0) {
                            $kwaktut = 'Sangat Kurang';
                        }
                        if ($nckuantitast != '0') {
                            $arrt[] = $nckuantitast;
                        }
                        if ($nckualitast != '0') {
                            $arrt[] = $nckualitast;
                        }
                        if ($ncwaktut != '0') {
                            $arrt[] = $ncwaktut;
                        }
                        
                        $avgt = round(array_sum($arrt) / count($arrt));
                        if ($avgt > 100) {
                            $nat = 120;
                            $ntt = 0.8 * 120 + 0.2 * 80;
                        } elseif ($avgt > 80) {
                            $nat = 100;
                            $ntt = 0.8 * 100 + 0.2 * 80;
                        } elseif ($avgt > 60) {
                            $nat = 80;
                            $ntt = 0.8 * 80 + 0.1 * 80;
                        } elseif ($avgt > 25) {
                            $nat = 60;
                            $ntt = 0.8 * 60 + 0.05 * 80;
                        } else {
                            $nat = 25;
                            $ntt = 0.8 * 25 + 0.01 * 80;
                        }
                        
                    @endphp
                    <tr>
                        <td>{{ $nob++ }}</td>
                        <td colspan="2" rowspan="3">{{ $t->tugas }}</td>
                        <td>Kuantitas</td>
                        <td>{{ $t->ikikuantitas }} </td>
                        <td>{{ $t->tkuantitas }}</td>
                        <td>-</td>
                        <td>{{ $t->tkuantitasmax }}</td>
                        <td>{{ $t->satuankuantitas }}</td>
                        <td>{{ $t->rkuantitas }}</td>
                        <td>{{ $nckuantitast }}</td>
                        <td>{{ $kkuant }}</td>
                        <td style="text-align: center" rowspan="3">{{ $t->nilai_capaian }}</td>
                        <td style="text-align: center" rowspan="3">{{ $t->nilai_mutu }}</td>
                        @php
                            
                            $naar[] = $t->nilai_capaian;
                            $ntar[] = $t->nilai_mutu;
                            
                        @endphp

                    </tr>

                    <tr>
                        <td></td>
                        <td>Kualitas</td>
                        <td>{{ $t->ikikualitas }}</td>
                        <td>{{ $t->tkualitas }}</td>
                        <td>-</td>
                        <td>{{ $t->tkualitasmax }}</td>
                        <td>{{ $t->satuankualitas }}</td>
                        <td>{{ $t->rkualitas }}</td>
                        <td>{{ $nckualitast }}</td>
                        <td>{{ $kkualt }}</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>Waktu</td>
                        <td>{{ $t->ikiwaktu }}</td>
                        <td>{{ $t->twaktu }}</td>
                        <td>-</td>
                        <td>{{ $t->twaktumax }}</td>
                        <td>{{ $t->satuanwaktu }}</td>
                        <td>{{ $t->rwaktu }}</td>
                        <td>{{ $ncwaktut }}</td>
                        <td>{{ $kwaktut }}</td>

                    </tr>
                    @php $cekb++ @endphp
                    @php $cekb= 1; @endphp
                @endforeach
            @endif

            <tr class="bgrow">
                <td style="text-align: center" colspan="12"><b> NILAI AKHIR SKP</b></td>


                <th style=" text-align:left">{{ round(array_sum($naar) / count($naar), 2) }}</th>
                <th style=" text-align:left">{{ round(array_sum($ntar) / count($ntar), 2) }}</th>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;" class="">
        <thead>
            <tr>
                <td style="width: 80%; border: 0px">


                </td>
                <td style="width:20%;border: 0px">
                    <p>Makassar, ....../....../..........</p>
                    <p>Pejabat Penilai Kinerja,</p>
                    <br><br><br>
                    <p><u> {{ $ap->nama }}</u></p>

                    <p>NIP. {{ $ap->nip }} </p>
                </td>
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
