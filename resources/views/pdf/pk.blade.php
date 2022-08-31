@extends('pdf.layouts')

@section('content')
    <style>
        * {
            font-size: 12px
        }

    </style>
    <h2 class="" style="text-align: center;">PENILAIAN PERILAKU KERJA</h2>

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
            <tr>
                <td><b>No</b></td>

                <td style="text-align:center" colspan="2"> <b> Aspek Perilaku</b></td>
                <td style="text-align:center" colspan="3">
                    <b>Nilai</b>
                </td>


            </tr>
            <tr>
                <td>1</td>

                <td colspan="2"> <b> Orientasi Pelayanan</b></td>
                <td colspan="3">
                    {{ $orien }}
                </td>
            </tr>
            <tr>
                <td>2</td>

                <td colspan="2"> <b> Inisiatif Kerja</b></td>
                <td colspan="3">
                    {{ $inis }}
                </td>
            </tr>
            <tr>
                <td>3</td>

                <td colspan="2"> <b> Komitmen</b></td>
                <td colspan="3">
                    {{ $komit }}
                </td>
            </tr>
            <tr>
                <td>4</td>

                <td colspan="2"> <b> Kerjasama</b></td>
                <td colspan="3">
                    {{ $kerjas }}
                </td>
            </tr>
            <tr>

                <td style="text-align: center" colspan="3"> <b> Nilai Akhir</b></td>
                <td colspan="3">
                    {{ $totalPk }}
                </td>
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
