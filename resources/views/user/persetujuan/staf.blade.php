@extends('user.index')

@section('cssc')
    <link href="{{ asset('minton/assets/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatable-rowgroup/css/rowGroup.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .tooltips {
            position: relative;
            display: inline-block;
            z-index: 1;

        }

        .tooltips .tooltiptext {
            font-size: 12px;
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;

            /* Position the tooltip */
            width: 120px;
            bottom: 100%;
            left: 50%;
            margin-left: -60px;
            /* Use half of the width (120/2 = 60), to center the tooltip */
            position: absolute;
            z-index: 2;
        }

        .tooltips:hover .tooltiptext {
            visibility: visible;
        }

    </style>
    <style>
        .bd-example-modal-lg .modal-dialog {
            display: table;
            position: relative;
            margin: 0 auto;
            top: calc(50% - 24px);
        }

        .bd-example-modal-lg .modal-dialog .modal-content {
            background-color: transparent;
            border: none;
        }

        td.details-control {
            background: url('{{ asset('img/open.png') }}') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('{{ asset('img/close.png') }}') no-repeat center center;
        }

    </style>
    <link href="{{ asset('minton/assets/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('minton/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box page-title-box-alt">
                        <h4 class="page-title">Persetujuan Rencana SKP Pegawai</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Penilaian Staf</a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="staf" class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Status</th>

                                            <th scope="col">Aksi</th>

                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>






        </div> <!-- container -->

    </div> <!-- content -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Target SKP Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="float-left pr-2" id="btnpegawai">

                            </div>
                            <button id="rk" type="button" class="btn btn-sm btn-primary mb-2 mr-1">Rincian
                                Kegiatan</button>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div class="float-right pr-2" id="btntolak">

                            </div>
                            <div class="float-right" id="btnconfirm">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-centered wrap w-100 table-sm"
                                    id="rencanaskp">
                                    <thead class="thead-light">
                                        <tr class="">
                                            <th>#</th>
                                            <th></th>
                                            <th>Kinerja Utama</th>
                                            <th></th>
                                            <th></th>
                                            <th>Total Rencana Kerja</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-right pl-2" id="btntolak">


                            </div>
                            <div class="float-right" id="btnconfirm">


                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="bs-example-modal-lgtt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Target SKP Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="float-left pr-2" id="btnpegawait">

                            </div>

                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div class="float-right pr-2" id="btntolakt">

                            </div>
                            <div class="float-right" id="btnconfirmt">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-centered wrap w-100 table-sm"
                                    id="rencanaskpt">
                                    <thead class="thead-light">
                                        <tr class="">
                                            <th>#</th>
                                            <th></th>
                                            <th>Tugas Tambahan</th>
                                            <th></th>
                                            <th></th>
                                            <th>Total Tugas Tambahan</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="penolakan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Keterangan Penolakan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="formpenolakan" action="">
                    @csrf
                    <input type="hidden" name="id" id="idpen">
                    <div class="modal-body">
                        <div class="form-group no-margin">
                            <textarea class="form-control" rows="5" name="ket" id="field-7" placeholder="Keterangan Penolakan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="sbt" type="submit"
                            class="btn btn-sm btn-info waves-effect waves-light">Kirim</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="penolakant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Keterangan Penolakan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form id="formpenolakant" action="">
                    @csrf
                    <input type="hidden" name="id" id="idpent">
                    <input type="hidden" name="ids" value="2">

                    <div class="modal-body">
                        <div class="form-group no-margin">
                            <textarea class="form-control" rows="5" name="ket" id="field-7" placeholder="Keterangan Penolakan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="sbtt" type="submit"
                            class="btn btn-sm btn-info waves-effect waves-light">Kirim</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="datapegawai" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.2);"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Biodata Pegawai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row" id="infopegawai"></div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal loader fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>
@endsection
@push('js')
    <!-- Tippy js-->

    <script>
        $(document).ready(function() {

        });


        var tabel2;
        let url = window.location.origin;
        $("#rk").on('click', function() {
            $(".details-control").trigger('click');
        })

        function setuju(id, ids) {
            console.log(id);
            let check = confirm('Klik Ya Untuk Melanjutkan');
            if (check) {
                $.ajax({
                    url: "{{ route('p_setuju.staf') }}",
                    type: 'GET',
                    data: {
                        id: id,
                        ids: ids
                    },
                    success: function(e) {
                        console.log(e);
                        if (e == 'success') {
                            tabel2.ajax.reload();
                            $("#toastr-three").trigger("click");


                        }
                    }
                });
            }

        }

        function setujut(id, ids) {
            if (ids == 1) {
                console.log(id);
                let check = confirm('Klik Ya Untuk Melanjutkan');
                if (check) {
                    $.ajax({
                        url: "{{ route('p_setuju.tugas') }}",
                        type: 'GET',
                        data: {
                            id: id,
                            ids: ids
                        },
                        success: function(e) {
                            console.log(e);
                            if (e == 'success') {
                                tabel2.ajax.reload();
                                $("#toastr-three").trigger("click");


                            }
                        }
                    });
                }
            } else {
                $("#penolakant").modal('show');
                $("#idpent").val(id);
                console.log(id);
                console.log(ids);
            }


        }

        function pegawai(e) {
            $("#datapegawai").modal('show');
            $.ajax({
                url: "{{ route('p_lihat.pegawai') }}",
                type: 'GET',
                data: {
                    id: e
                },
                success: function(e) {

                    $("#infopegawai").html(e['pp']);


                    console.log(e);

                }
            });
        }

        function lihattugas(id) {
            $("#bs-example-modal-lgtt").modal('show');
            console.log(id);
            if ($.fn.DataTable.isDataTable("#rencanaskpt")) {
                $('#rencanaskpt').DataTable().clear().destroy();
            }
            tabel = $("#rencanaskpt").DataTable({
                "lengthChange": false,
                "bPaginate": false, //hide pagination
                "bInfo": false, // hide showing entries
                "bFilter": false, //hide Search bar

                fnInitComplete: function() {

                    function dataloop(d) {
                        console.log(d);
                        var arrs = '';
                        arrs = `  <tr class="table-warning">
                                            <th colspan="2">No</th>
                                            <th>Rencana Kinerja</th>
                                            <th>Aspek</th>
                                            <th>IKI</th>
                                            <th>Target</th>
                                        </tr>`;
                        no = 1;
                        d['tugas'].forEach(element => {

                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-center" rowspan="3" colspan="2"><b>' +
                                no++
                                +
                                '</b></td>' +
                                '<td class="text-left" rowspan="3" colspan="1"><b>' + element[
                                    "tugas"] + '</b></td>' +
                                '<td class="text-left"  colspan="1"><b>' + 'Kuantitas' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikikuantitas"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["tkuantitas"] +
                                ' - ' + element[
                                    "tkuantitasmax"] + ' ' + element["satuankuantitas"]
                            '</b></td>' +
                            '</tr>';

                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-left" colspan="1"><b>' + 'Kualitas' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikikualitas"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["tkualitas"] + ' - ' +
                                element[
                                    "tkualitasmax"] + ' ' + element["satuankualitas"]
                            '</b></td>' +
                            '</tr>';
                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-left" colspan="1"><b>' + 'Waktu' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikiwaktu"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["twaktu"] + ' - ' +
                                element[
                                    "twaktumax"] + ' ' + element["satuanwaktu"]
                            '</b></td>' +
                            '</tr>';

                        });
                        arrs = arrs + '<tr>' + '<td class="text-left" colspan="2"><b>' +
                            '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '' + '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '' +
                            '</b></td>' + '<td class="text-left" colspan="1"><b>' + '' +
                            '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '</b></td>' +
                            '</tr>';
                        return arrs;
                    }
                    $('#rencanaskpt tbody').on('click', 'td.details-control', function() {

                        var tr = $(this).closest('tr');
                        var row = tabel.row(tr);
                        if ($(tr).hasClass('ada')) {
                            $(tr).removeClass('ada');

                            $(tr.nextUntil('[role="row"]')).remove();
                        }

                        $(tr).addClass('ada');

                        $(tr).after(dataloop(row.data()));
                        console.log($(tr.next()));

                    });
                    $('#rencanaskpt tbody td.details-control').trigger('click')

                },
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "1%",
                    },

                    {
                        targets: 1,
                        width: "1%",
                        orderable: false,

                    }, {
                        orderable: false,
                        targets: 2,
                        width: "40%",

                    }, {
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
                        width: "15%",

                    }
                ],

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('p_lihat.tugas') }}",
                    data: {
                        id: id
                    },
                    "complete": function(xhr, responseText) {
                        console.log(xhr);
                        console.log(responseText); //*** responseJSON: Array[0]
                    }
                },
                columns: [{
                        nama: 'status',
                        data: 'status'
                    },
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "data": null,
                        "defaultContent": ''
                    }, {
                        nama: 'status',
                        data: 'status'
                    }, {
                        nama: 'status',
                        data: 'status'
                    }, {
                        nama: 'status',
                        data: 'status'
                    },
                    {
                        nama: 'aksi',
                        data: 'aksi',
                        "className": 'text-center',

                    },



                ]
            });
            $.ajax({
                url: "{{ route('p_lihat.akuntugas') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(e) {

                    $("#btnconfirmt").html(e['btn']);
                    $("#btntolakt").html(e['btnt']);
                    $("#btnpegawait").html(e['info']);

                    console.log(e);
                    if (e == 'success') {
                        tabel2.ajax.reload();

                    }
                }
            });

        }

        function lihat1(id) {
            $("#bs-example-modal-lg").modal('show');
            console.log(id);
            if ($.fn.DataTable.isDataTable("#rencanaskp")) {
                $('#rencanaskp').DataTable().clear().destroy();
            }
            tabel = $("#rencanaskp").DataTable({
                "lengthChange": false,
                "bPaginate": false, //hide pagination
                "bInfo": false, // hide showing entries
                "bFilter": false, //hide Search bar

                fnInitComplete: function() {
                    function dataloop(d) {
                        console.log(d);
                        var arrs = '';
                        arrs = `  <tr class="table-warning">
                                            <th colspan="2">No</th>
                                            <th>Rencana Kinerja</th>
                                            <th>Aspek</th>
                                            <th>IKI</th>
                                            <th>Target</th>
                                        </tr>`;
                        no = 1;
                        d['target'].forEach(element => {

                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-center" rowspan="3" colspan="2"><b>' +
                                no++
                                +
                                '</b></td>' +
                                '<td class="text-left" rowspan="3" colspan="1"><b>' + element[
                                    "kegiatan"] + '</b></td>' +
                                '<td class="text-left"  colspan="1"><b>' + 'Kuantitas' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikikuantitas"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["tkuantitas"] +
                                ' - ' + element[
                                    "tkuantitasmax"] + ' ' + element["satuan"]
                            '</b></td>' +
                            '</tr>';

                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-left" colspan="1"><b>' + 'Kualitas' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikikualitas"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["tkualitas"] + ' - ' +
                                element[
                                    "tkualitasmax"] + ' ' + element["satuankualitas"]
                            '</b></td>' +
                            '</tr>';
                            arrs = arrs + '<tr class="table-info">' +
                                '<td class="text-left" colspan="1"><b>' + 'Waktu' +
                                '</b></td>' + '<td class="text-left" colspan="1"><b>' + element[
                                    "ikiwaktu"] +
                                '</b></td>' +
                                '<td class="text-left" colspan="1"><b>' + element["twaktu"] + ' - ' +
                                element[
                                    "twaktumax"] + ' ' + element["satuanwaktu"]
                            '</b></td>' +
                            '</tr>';

                        });
                        arrs = arrs + '<tr>' + '<td class="text-left" colspan="2"><b>' +
                            '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '' + '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '' +
                            '</b></td>' + '<td class="text-left" colspan="1"><b>' + '' +
                            '</b></td>' +
                            '<td class="text-left" colspan="1"><b>' + '</b></td>' +
                            '</tr>';
                        return arrs;
                    }
                    $('#rencanaskp tbody').on('click', 'td.details-control', function() {
                        console.log('sd');
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
                },
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "1%",
                    },

                    {
                        targets: 1,
                        width: "1%",
                        orderable: false,

                    }, {
                        orderable: false,
                        targets: 2,
                        width: "40%",

                    }, {
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
                        width: "15%",

                    }
                ],

                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('p_lihat.rskp') }}",
                    data: {
                        id: id
                    },
                    "complete": function(xhr, responseText) {
                        console.log(xhr);
                        console.log(responseText); //*** responseJSON: Array[0]
                    }
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
                        nama: 'rencana',
                        data: 'rencana'
                    }, {
                        nama: 'total',
                        data: 'total'
                    }, {
                        nama: 'status',
                        data: 'status'
                    },
                    {
                        nama: 'aksi',
                        data: 'aksi',
                        "className": 'text-center',

                    },



                ]
            });
            $.ajax({
                url: "{{ route('p_lihat.akun') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(e) {

                    $("#btnconfirm").html(e['btn']);
                    $("#btntolak").html(e['btnt']);
                    $("#btnpegawai").html(e['info']);

                    console.log(e);
                    if (e == 'success') {
                        tabel2.ajax.reload();

                    }
                }
            });

        }

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




        function lihat2(id) {
            $("#bs-example-modal-lg").modal('show');


            $.ajax({
                url: "{{ route('p_lihat2.staf') }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(e) {
                    $("#pppegawai").html(e['pp']);
                    $("#bodytabel").html(e['skp']);
                    $("#btnconfirm").html(e['btn']);
                    $("#btntolak").html(e['btnt']);
                    console.log(e['skp']);
                    if (e == 'success') {
                        tabel2.ajax.reload();
                    }
                }
            });

        }
        $(document).ready(function() {
            $("#sbt").on('click', function(e) {
                $("#formpenolakan").trigger('submit');
            })
            $("#sbtt").on('click', function(e) {
                $("#formpenolakant").trigger('submit');
            })
            $("#formpenolakan").on('submit', function(e) {
                e.preventDefault();
                var datapen = $(this).serialize();
                console.log(datapen);
                $.ajax({
                    url: "{{ route('p_tolak.staf') }}",
                    type: 'GET',
                    data: datapen,
                    success: function(e) {
                        console.log(e);
                        if (e == 'success') {
                            tabel2.ajax.reload();
                            $("#toastr-three").trigger("click");

                        }
                    }
                });

            })
            $("#formpenolakant").on('submit', function(e) {
                e.preventDefault();
                var datapen = $(this).serialize();
                console.log(datapen);
                $.ajax({
                    url: "{{ route('p_setuju.tugas') }}",
                    type: 'get',
                    data: datapen,
                    success: function(e) {
                        console.log(e);
                        if (e == 'success') {
                            tabel2.ajax.reload();
                            $("#toastr-three").trigger("click");

                        }
                    }
                });

            })
        });


        function tolak(id, ids) {
            $("#penolakan").modal('show');
            $("#idpen").val(id);
            console.log(id);
            console.log(ids);
            // let check = confirm('Klik Ya Untuk Melanjutkan');
            if (check) {

            }

        }


        tabel2 = $("#staf").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('setuju.staf') }}"
            },
            columnDefs: [{
                    orderable: false,
                    targets: 0,
                    width: "5%",
                },
                {
                    orderable: false,
                    targets: 1,
                    width: "10%",
                },
                {
                    orderable: false,
                    targets: 6,
                    width: "10%",

                },

            ],
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'nip',
                    data: 'nip'
                },
                {
                    nama: 'nama',
                    data: 'nama'
                },
                {
                    nama: 'jabatan',
                    data: 'jabatan'
                },
                {
                    nama: 'period',
                    data: 'period'
                }, {
                    nama: 'status',
                    data: 'status'
                },

                {
                    nama: 'aksi',
                    data: 'aksi'
                },
            ]
        });
    </script>
    <script src="{{ asset('minton/assets/libs/datatable-rowgroup/js/dataTables.rowGroup.min.js') }}"></script>
@endpush
