@extends('pdf.layouts')

@section('content')
    <h2 class="" style="text-align: center;">RENCANA SKP PEGAWAI</h2>

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
        <tbody>
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
        </tbody>
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
            <tr class="bgrow">
                <th colspan="5" style=" text-align:left">B. TUGAS TAMBAHAN</th>
                <th style=" text-align:left">MIN</th>
                <th style=" text-align:left">-</th>
                <th style=" text-align:left">MAX</th>
                <th style=" text-align:left"></th>
            </tr>
            <tr>
                <td>1</td>
                <td style="vertical-align:top" rowspan="3">


                </td>


                <td rowspan="3">Rencana Kinerja Tambahan 1
                    (diisi dengan rencana kinerja yang telah dituangkan dalam matriks peran dan hasil/direktif/ penugasan
                    diluar tugas
                    pokok jabata</td>
                <td>Kuantitas</td>
                <td> </td>
                <td></td>
                <td>-</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>

                <td>Kualitas</td>
                <td> </td>
                <td></td>
                <td>-</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>

                <td>Waktu</td>
                <td> </td>
                <td></td>
                <td>-</td>
                <td></td>
                <td></td>
            </tr>
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
                    <p>Makassar, {{ $tanggal }}</p>
                    <p>Pejabat Penilai Kinerja,</p>
                    <br><br><br>
                    <p><u> {{ $ap->nama }}</u></p>

                    <p>NIP. {{ $ap->nip }} </p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
