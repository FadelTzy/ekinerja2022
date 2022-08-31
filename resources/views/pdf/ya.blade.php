@extends('pdf.layouts')

@section('content')
    <h2 class="" style="text-align: center;">SASARAN KINERJA PEGAWAI</h2>

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
                <th style="width: 5%; text-align:center">No</th>
                <th class="text-center" style="width: 20%; text-align:center">Rencana Kinerja
                </th>
                <th class="text-center" style="width: 30%; text-align:center">Rencana Kinerja
                </th>
                <th class="text-center" style="width: 8%; text-align:center">Aspek
                </th>
                <th class="text-center" style="width: 20%; text-align:center">Indikator Kinerja Individu
                </th>
                <th colspan="4" class="text-center" style="width: 20%; text-align:center">Target
                </th>
            </tr>
            <tr class="bgrow">
                <th style="width: 5%; text-align:center">(1)</th>
                <th class="text-center" style="width: 20%; text-align:center">(2)
                </th>
                <th class="text-center" style="width: 30%; text-align:center">(3)
                </th>
                <th class="text-center" style="width: 8%; text-align:center">(4)
                </th>
                <th class="text-center" style="width: 20%; text-align:center">(5)
                </th>
                <th colspan="4" class="text-center" style="width: 20%; text-align:center">(6)
                </th>
            </tr>
            <tr class="bgrow">
                <th colspan="5" style=" text-align:left">A. KINERJA UTAMA</th>
                <th style=" text-align:left">MIN</th>
                <th style=" text-align:left">-</th>
                <th style=" text-align:left">MAX</th>
                <th style=" text-align:left"></th>

            </tr>
        </thead>
        <tbody>

            @php $no = 1 @endphp
            @php $cek = 1 @endphp
            @foreach ($target->getData()->data as $it => $t)
                @foreach ($t->target as $i => $item)
                    <tr>
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

                    </tr>

                    <tr>
                        <td></td>
                        <td>Kualitas</td>
                        <td>{{ $item->ikikualitas }}</td>
                        <td>{{ $item->tkualitas }}</td>
                        <td>-</td>
                        <td>{{ $item->tkualitasmax }}</td>
                        <td>{{ $item->satuankualitas }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Waktu</td>
                        <td>{{ $item->ikiwaktu }}</td>
                        <td>{{ $item->twaktu }}</td>
                        <td>-</td>
                        <td>{{ $item->twaktumax }}</td>
                        <td>{{ $item->satuanwaktu }}</td>
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
                    <th style=" text-align:left"></th>
                </tr>
                @php $nob = 1 @endphp
                @php $cekb = 1 @endphp
                @foreach ($tugas->getData()->data as $it => $t)
                    <tr>
                        <td>{{ $nob++ }}</td>


                        <td colspan="2" rowspan="3">{{ $t->tugas }}</td>
                        <td>Kuantitas</td>
                        <td>{{ $t->ikikuantitas }} </td>
                        <td>{{ $t->tkuantitas }}</td>
                        <td>-</td>
                        <td>{{ $t->tkuantitasmax }}</td>
                        <td>{{ $t->satuankuantitas }}</td>

                    </tr>

                    <tr>
                        <td></td>
                        <td>Kualitas</td>
                        <td>{{ $t->ikikualitas }}</td>
                        <td>{{ $t->tkualitas }}</td>
                        <td>-</td>
                        <td>{{ $t->tkualitasmax }}</td>
                        <td>{{ $t->satuankualitas }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Waktu</td>
                        <td>{{ $t->ikiwaktu }}</td>
                        <td>{{ $t->twaktu }}</td>
                        <td>-</td>
                        <td>{{ $t->twaktumax }}</td>
                        <td>{{ $t->satuanwaktu }}</td>
                    </tr>
                    @php $cekb++ @endphp
                    @php $cekb= 1; @endphp
                @endforeach
            @endif
        </tbody>
    </table>
    <table style="width: 100%;" class="">
        <tbody>
            <tr>
                <td style="width: 80%; border: 0px">
                    <p>Pejabat yang dinilai,</p>
                    <br><br><br>
                    <p><u> {{ Auth::user()->nama }}</u></p>

                    <p>NIP.{{ Auth::user()->nip }}</p>

                </td>
                <td style="width:20%;border: 0px">
                    <p>Makassar, ....../....../..........</p>
                    <p>Pejabat Penilai Kinerja,</p>
                    <br><br><br>
                    <p><u> {{ $ap->nama }}</u></p>

                    <p>NIP. {{ $ap->nip }} </p>
                </td>
            </tr>
        </tbody>
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
