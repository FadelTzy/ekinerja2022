@extends('user.index')

@section('cssc')
    <link href="{{ asset('minton/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatable-rowgroup/css/rowGroup.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css" />

    <style>
        td.details-control {
            background: url('{{ asset('img/open.png') }}') no-repeat center center;
            cursor: pointer;
        }

        .sorting,
        .sorting_asc,
        .sorting_desc {
            background: none;
        }

        tr.shown td.details-control {
            background: url('{{ asset('img/close.png') }}') no-repeat center center;
        }

        td {
            text-align: center;
        }

    </style>
@endsection

@section('body')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                @if (!Session::has('period'))
                    <div class="col-12">

                        <div class=" float-right">
                            <div class="text-danger pt-2">
                                Session Belum Di Set
                            </div>
                        </div>

                    </div>
                @endif

                <div class="col-12">
                    <div class="page-title-box page-title-box-alt">
                        <h4 class="page-title">Pengajuan Realisasi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pengajuan</a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (Session::get('id_periode') == 'null')
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger d-flex justify-content-between" role="alert">
                            <div>
                                <h4 class="page-title">Tugas Jabatan Anda Untuk {{ $datap->nama_periode }} <i>Tidak
                                        Terdaftar</i></h4>
                                <h6 class="page-body">Silahkan Melakukan Pengajuan Tugas Jabatan Ke Operator</h6>
                            </div>
                            <div>
                                <i class="fa fa-4x fa-exclamation-triangle  mr-2"></i>
                            </div>

                        </div>

                    </div>
                </div>
            @else
                @if (Session::get('id_status') == 3 || Session::get('id_status') == 2)
                    <div class="row">

                        <div class="col-12">
                            <div class="alert alert-danger d-flex justify-content-between" role="alert">
                                <div>
                                    <h4 class="page-title">Anda Belum Dapat Mengajukan Realisasi Bulanan Sebelum Atasan
                                        Menyetujui Rancangan Target Semester</h4>
                                    <h6 class="page-body">Silahkan Menghubungi Atasan Untuk Melakukan Persetujuan
                                        Rancangan Target Semester</h6>

                                </div>
                                <div>
                                    <i class="fa fa-4x fa-exclamation-triangle  mr-2"></i>
                                </div>

                            </div>

                        </div>
                    </div>
                @elseif(Session::get('id_status') == 0)
                    <div class="row">

                        <div class="col-12">
                            <div class="alert alert-danger d-flex justify-content-between" role="alert">
                                <div>
                                    <h4 class="page-title">Anda Belum Menyusun Rancangan Target Semester
                                        {{ $datap->nama_periode }}</h4>
                                </div>
                                <div>
                                    <i class="fa fa-3x fa-exclamation-triangle  mr-2"></i>
                                </div>

                            </div>

                        </div>
                    </div>
                @else
                    @if ($id_mn->adendum == 1 || $id_mn->adendum == 2)
                        <div class="row">

                            <div class="col-12">
                                <div class="alert alert-danger d-flex justify-content-between" role="alert">
                                    <div>
                                        <h4 class="page-title">Belum Dapat Mengajukan Realisasi Bulanan Sebelum Atasan
                                            Menyetujui Adendum Anda</h4>
                                        <h6 class="page-body">Silahkan Menghubungi Atasan Untuk Melakukan Persetujuan
                                            Rancangan Target Baru</h6>

                                    </div>
                                    <div>
                                        <i class="fa fa-4x fa-exclamation-triangle  mr-2"></i>
                                    </div>

                                </div>

                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">

                                                <button id="rk" type="button"
                                                    class="btn btn-sm btn-primary mb-2 mr-1">Rincian Kegiatan</button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"> <span class="btn-label"><i
                                                                class="fas fa-angle-down"></i></span>
                                                        Cetak Realisasi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" target="_blank"
                                                            href="{{ route('cetak.realisasiskp') }}">Realisasi SKP</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">

                                                    <a href="{{ route('realisasi.tugas') }}"
                                                        class="btn btn-success btn-sm mb-2"> <i
                                                            class="mdi mdi-plus-circle mr-1"></i>Realisasi Tugas
                                                        Tambahan</a>

                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-centered wrap w-100 table-sm"
                                                id="pengajuan">
                                                <thead class="thead-light">
                                                    <tr class="text-center">
                                                        <th rowspan="2"></th>
                                                        <th rowspan="2"></th>

                                                        <th rowspan="2">Rencana Kinerja</th>

                                                        <th rowspan="2">Status</th>
                                                        <th colspan="2">Capaian Rencana Kinerja</th>
                                                        <th rowspan="2">Edit</th>


                                                    </tr>
                                                    <tr class="text-center">
                                                        <th scope="col">Nilai Akhir</th>
                                                        <th scope="col">Nilai Tertimbang</th>
                                                    </tr>

                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    @endif


                    <!-- end row -->
                @endif
            @endif

        </div>






    </div> <!-- container -->

    <div class="modal fade" id="modal-pr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Pengajuan Realisasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" id="subtar" action="#">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" id="idtugas" name="idtugas">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Kinerja Utama</label>
                                        <textarea class="form-control" required id="kegiatan" readonly placeholder="Tugas" cols="20" rows="2"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail1">Kinerja</label>
                                        <textarea class="form-control" required readonly id="aktivitas" placeholder="Kegiatan" cols="20" rows="2"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Target Kuantitas</label>
                                        <div class="input-group">
                                            <input type="text" readonly class="form-control" id="targetkuantitas"
                                                placeholder="Laporan">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="skuan"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Realisasi</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" required name="realisasikuantitas"
                                                id="realisasikuantitas" placeholder="Realisasi Target">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="rkuan"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Target Kualitas</label>
                                        <div class="input-group">
                                            <input type="text" readonly class="form-control" id="targetkualitas"
                                                placeholder="Laporan">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="skual"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Realisasi</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" required name="realisasikualitas"
                                                id="realisasikualitas" placeholder="Realisasi Target">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="rkual2"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Target Waktu</label>
                                        <div class="input-group">
                                            <input type="text" readonly class="form-control" id="targetwaktu"
                                                placeholder="Laporan">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="swaktu"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Realisasi</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" required name="realisasiwaktu"
                                                id="realisasiwaktu" placeholder="Realisasi Target">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="rwaktu"></span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group col-md-12">
                                        <label for="keterangan">Keterangan Hasil Pekerjaan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan Hasil Pekerjaan" cols="20"
                                            rows="5"></textarea>
                                    </div> --}}
                                </div>

                                <button type="submit" id="btnsf" class="btn btn-primary">
                                    <span id="btnsf1" class="spinner-border-sm mr-1" role="status"
                                        aria-hidden="true"></span>
                                    <span id="btnsf2">Simpan</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>
    <div class="modal fade" id="lihatlog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Pengajuan Tugas Tambahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="formtt" action="" method="post">
                    <input type="hidden" name="id" value="{{ $id_mn->id ?? 'null' }}">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm  " style="width: 100%;" id="itemlog"
                                style="border-collapse: collapse; border-spacing: 0;">
                                <thead>
                                    <tr style="background-color: #2980b9; color: white">
                                        <td style="width: 45%;" colspan="2" class="col-md-4">Nilai Tambahan</td>
                                        <td style="width: 50%;">Keterangan</td>
                                        <td style="width: 5%;">Nilai</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-left" style="background-color: #ecf0f1">
                                        <td class="text-left" style="width: 20px;">1</td>
                                        <td>
                                            <div class="pull-left">
                                                Tugas Tambahan </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left">


                                        </td>

                                        <td>
                                            <textarea name="ket_1" style="width: 100%;" id="" name="desktt" cols="30" rows="10"></textarea>

                                        </td>
                                        <td class="text-center">
                                            <div id="nilai_1" style="font-size: 18px;">0</div>
                                        </td>
                                    </tr>
                                    <tr style="background-color: #ecf0f1">
                                        <td class="text-left" style="width: 20px;">2</td>
                                        <td>
                                            <div class="pull-left">
                                                Kreativitas </div>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnsft" class="btn btn-primary">
                            <span id="btnsf1t" class="spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                            <span id="btnsf2t">Simpan Nilai Tambahan</span>
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('js')
    <script>
        var tabel;
        var url = window.location.origin;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('input[name=ntambahan]').change(function() {
            var value = $('input[name=ntambahan]:checked').val();
            $("#nilai_1").html(value);
        });
        $('input[name=nkreativitas]').change(function() {
            var value = $('input[name=nkreativitas]:checked').val();
            $("#nilai_2").html(value);
        });
        $("#rk").on('click', function() {
            $(".details-control").trigger('click');
        })
        $("#formtt").on('submit', function(e) {
            e.preventDefault();
            $("#btnsft").attr('disabled', 'true');
            $("#btnsf2t").html('Simpan...')
            $("#btnsf1t").addClass('spinner-border ');
            let data = $(this).serialize();
            $.ajax({
                url: "{{ route('pengajuan-realisasi.nilaitambah') }}",
                data: data,
                type: 'post',
                success: function(e) {
                    $("#btnsft").removeAttr('disabled');
                    $("#btnsf2t").html('Simpan');
                    $("#btnsf1t").removeClass('spinner-border ');
                    $("#toastr-three").trigger("click");

                    console.log(e);
                }
            })

        })

        function realisasi(id) {
            $("#realisasikualitas").val('');
            $("#rkualitas").val('');
            $("#keterangan").val('');
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/skp/pengajuan-realisasi/' + id,
                type: 'get',
                success: function(e) {
                    $("#kegiatan").val(e.kinerja.rencana);
                    $("#aktivitas").val(e.kegiatan);
                    $("#targetkuantitas").val(e.tkuantitas + ' - ' +
                        e.tkuantitasmax);
                    $("#realisasikuantitas").val(e.rkuantitas);
                    $("#skuan").html(e.satuan);


                    $("#targetkualitas").val(e.tkualitas + ' - ' +
                        e.tkualitasmax);
                    $("#realisasikualitas").val(e.rkualitas);
                    $("#skual").html(e.satuankualitas);
                    $("#rkual2").html(e.satuankualitas);


                    $("#targetwaktu").val(e.twaktu + ' - ' +
                        e.twaktumax);
                    $("#realisasiwaktu").val(e.rwaktu);
                    $("#swaktu").html(e.satuanwaktu);
                    $("#rwaktu").html(e.satuanwaktu);

                    $("#rkuan").html(e.satuan);
                    $("#idtugas").val(id);

                    console.log(e)
                }
            })
        }

        $("#subtar").submit(function(e) {
            e.preventDefault();
            $("#btnsf").attr('disabled', 'true');
            $("#btnsf2").html('Simpan...')
            $("#btnsf1").addClass('spinner-border ');
            let data = $(this).serialize();

            $.ajax({
                url: "{{ route('pengajuan-realisasi.store') }}",
                data: data,
                type: 'post',
                success: function(e) {
                    $("#btnsf").removeAttr('disabled');
                    $("#btnsf2").html('Simpan');
                    $("#btnsf1").removeClass('spinner-border ');
                    $("#realisasikualitas").val('');
                    $("#rkualitas").val('');
                    $("#keterangan").val('');
                    console.log(e);
                    if (e == 'gagal') {
                        alert('Anda Belum Bisa Mengajukan Realisasi, Isi Log Harian Terlebih Dahulu');
                    } else {
                        tabel.ajax.reload();
                        $("#toastr-three").trigger("click");

                    }

                }
            })
        });

        function bulans(d) {
            let day;
            switch (d) {
                case "1":
                    day = "Januari";
                    break;
                case "2":
                    day = "Februari";
                    break;
                case "3":
                    day = "Maret";
                    break;
                case "4":
                    day = "April";
                    break;
                case "5":
                    day = "Mei";
                    break;
                case "6":
                    day = "Juni";
                    break;
                case "7":
                    day = "Juli";
                    break;
                case "8":
                    day = "Agustus";
                    break;
                case "9":
                    day = "September";
                    break;
                case "10":
                    day = "Oktober";
                    break;
                case "12":
                    day = "Desember";
                    break;
                case "11":
                    day = "November";
                    break;
            }
            return day;
        }

        function badge(id) {
            if (id == 0) {
                return '<h4 class="badge badge-warning"> Belum Melakukan Pengajuan</h4>'
            } else if (id == 1) {
                return '<h4 class="badge badge-info"> Menunggu Penilaian Atasan</h4>'
            } else {
                return '<h4 class="badge badge-success">Telah Dinilai</h4>'
            }
        }

        function checkbul(id) {
            if (id == 2 || id == 1) {
                return '1'
            } else {
                return '0';
            }
        }

        function checktheme(id) {
            if (id == 0 || id == 1) {
                return 'table-info'
            } else {
                return 'table-success'
            }
        }

        function adakah(e) {
            if (e) {
                return e;
            }
            return 0;
        }

        function hitung(min, max, realisasi) {
            if (min <= realisasi && max >= realisasi) {
                return 100;
            } else if (min > realisasi) {
                nilai = (realisasi / min) * 100;
                return Math.round(nilai);
            } else if (max < realisasi) {
                nilai = (realisasi / max) * 100;
                return Math.round(nilai);
            }
            return min + max;
        }

        function hitungt(min, max, realisasi) {
            if (min <= realisasi && max >= realisasi) {
                return 100;
            } else if (min > realisasi) {
                nilai = 1 - (realisasi / min);
                nilai = 100 + (nilai * 100);
                return Math.round(nilai);
            } else if (max < realisasi) {
                nilai = (realisasi / max) - 1;
                nilai = 100 - (nilai * 100);
                return Math.round(nilai);
            }
            return min + max;
        }

        function kategori(nilai) {
            if (nilai >= 101) {
                return 'Sangat Baik';
            } else if (nilai == 100) {
                return 'Baik';
            } else if (nilai >= 80) {
                return 'Cukup';
            } else if (nilai >= 60) {
                return 'Kurang';
            } else if (nilai >= 0) {
                return 'Sangat Kurang';
            }
        }

        function dataloop(d) {
            var arrs = '';
            console.log(d);
            arrs = arrs + '<tr class="table-warning" >' +
                '<td class="text-left" colspan="2"><b>' + 'Aspek ' + '</b></td>' +
                '<td class="text-left" ><b>' + 'Indikator Kinerja Individu' + '</b></td>' +
                '<td class="text-center" ><b>' + 'Target' + '</b></td>' +
                '<td class="text-center" ><b>' + 'Realisasi' + '</b></td>' +
                '<td class="text-left" ><b>' + 'Capaian IKI' + '</b></td>' +
                '<td class="text-left" ><b>' + 'Kategori IKI' + '</b></td>' +

                '</tr>';
            arrs = arrs + '<tr class="table-info">' +
                '<td class="text-left" colspan="2"><b>' + 'Kuantitas ' + '</b></td>' +
                '<td class="text-left" ><b>' + d['ikikuantitas'] + '</b></td>' +
                '<td class="text-center" ><b>' + d["tkuantitas"] + ' - ' + d["tkuantitasmax"] +
                ' ' + d["satuan"] + '</b></td>' +
                '<td class="text-center" ><b>' + d["rkuantitas"] + ' ' + d[
                    "satuan"
                ] + '</b></td>' +
                '<td class="text-left" ><b>' + hitung(d["tkuantitas"], d["tkuantitasmax"], d["rkuantitas"]) + '%' +
                '</b></td>' +
                '<td class="text-left" ><b>' + kategori(hitung(d["tkuantitas"], d["tkuantitasmax"], d["rkuantitas"])) +
                '</b></td>' +
                '</tr>';
            arrs = arrs + '<tr class="table-info">' +
                '<td class="text-left" colspan="2"><b>' + 'Kualitas ' + '</b></td>' +
                '<td class="text-left" ><b>' + d['ikikualitas'] + '</b></td>' +
                '<td class="text-center" ><b>' + d["tkualitas"] + ' - ' + d["tkualitasmax"] + ' ' +
                d[
                    "satuankualitas"
                ] + '</b></td>' +
                '<td class="text-center" ><b>' + d["rkualitas"] + '% ' + d[
                    "satuankualitas"
                ] + '</b></td>' +
                '<td class="text-left" ><b>' + hitung(parseInt(d["tkualitas"]), parseInt(d["tkualitasmax"]), d[
                    "rkualitas"]) + '%' +
                '</b></td>' +
                '<td class="text-left" ><b>' + kategori(hitung(parseInt(d["tkualitas"]), parseInt(d["tkualitasmax"]), d[
                    "rkualitas"])) +
                '</b></td>' +
                '</tr>';
            arrs = arrs + '<tr class="table-info">' +
                '<td class="text-left" colspan="2"><b>' + 'Waktu ' + '</b></td>' +
                '<td class="text-left" ><b>' + d['ikiwaktu'] + '</b></td>' +
                '<td class="text-center" ><b>' + d["twaktu"] + ' - ' + d["twaktumax"] + ' ' + d[
                    "satuanwaktu"
                ] + '</b></td>' +
                '<td class="text-center" ><b>' + d["rwaktu"] + ' ' + d[
                    "satuanwaktu"
                ] + '</b></td>' +
                '<td class="text-left" ><b>' + hitungt(d["twaktu"], d["twaktumax"], d["rwaktu"]) + '%' + '</b></td>' +
                '<td class="text-left" ><b>' + kategori(hitungt(d["twaktu"], d["twaktumax"], d["rwaktu"])) + '</b></td>' +
                '</tr>';
            // d['indexes'].forEach(element => {
            //     arrs = arrs + '<tr >' +
            //         '<td class="text-left" colspan="3"><b>' + 'Bulan ' + bulans(d[element]["bulan"]) + '</b></td>' +
            //         '<td class="text-right" colspan="3">' + '<b>Status : <b/>' + badge(d[element]["status"]) +
            //         '</td>' +
            //         '</tr>' +
            //         '<tr class="' + checktheme(d[element]["status"]) + '">' +

            //         '<td  colspan="3" rowspan="2" class="text-left">' + d[element]["kegiatan"] + '</td>' +

            //         '<td>' + '<p><b>Target</b></p>' + d[element]["tkuantitas"] + ' ' + d[element]["satuan"] +
            //         '</td>' +
            //         '<td>' + '1' + '</td>' +
            //         '<td>' + adakah(d[element]["nilai_atasan"]) + '</td>' +
            //         '</tr>' +
            //         '<tr class="' + checktheme(d[element]["status"]) + '">' +

            //         '<td>' + '<p><b>Realisasi</b></p>' + d[element]["rkuantitas"] + ' ' + d[element]["satuan"] +
            //         '</td>' +
            //         '<td>' + checkbul(d[element]["status"]) + '</td>' +
            //         '<td>' + '<button data-toggle="modal" data-target="#modal-pr" onclick="realisasi(' + d[element][
            //             "id"
            //         ] +
            //         ')" href="javascript:void(0);" class="btn btn-sm btn-primary mb-2"><i class="fa fa-edit"></i></button>' +
            //         '</td>' +


            //         '</tr>';
            // });

            return arrs;
        }


        $(document).ready(function() {
            tabel = $("#pengajuan").DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "1%",
                    },


                    {
                        targets: 1,
                        width: "1%",
                        orderable: false,

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "40%",
                        className: "text-left"

                    },
                    {
                        orderable: false,
                        targets: 3,
                        width: "10%",

                    },

                    {
                        orderable: false,
                        targets: 4,
                        width: "10%",

                    },

                    {
                        orderable: false,
                        targets: 5,
                        width: "10%",

                    },

                    {
                        orderable: false,
                        targets: 6,
                        width: "1%",

                    }
                ],

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pengajuan-realisasi.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    },
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    }, {
                        nama: 'kegiatan',
                        data: 'kegiatan'
                    }, {
                        nama: 'statuss',
                        data: 'statuss'
                    }, {
                        nama: 'nakhir',
                        data: 'nakhir'
                    },
                    {
                        nama: 'nitam',
                        data: 'nitam'
                    }, {
                        nama: 'edit',
                        data: 'edit'
                    },
                ]
            });
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log(message);
            };

            $('#pengajuan tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = tabel.row(tr);
                if ($(tr).hasClass('ada')) {
                    $(tr).removeClass('ada');

                    $(tr.nextUntil('[role="row"]')).remove();
                } else {
                    $(tr).addClass('ada');

                    $(tr).after(dataloop(row.data()));
                    console.log($(tr.next()));
                }

            });


        });
    </script>
    <script src="{{ asset('minton/assets/libs/datatable-rowgroup/js/dataTables.rowGroup.min.js') }}"></script>
@endpush
