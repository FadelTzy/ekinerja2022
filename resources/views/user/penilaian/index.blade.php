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
        .tzey {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

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

        .tdk td {
            text-align: left;
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
                        <h4 class="page-title">Penilaian Realisasi</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Penilaian</a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-bordered table-centered wrap w-100 table-sm" id="penilaian">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Status Pengajuan</th>
                                            <th>Nilai Akhir</th>
                                            <th>Nilai Tertimbang</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end row -->

        </div>






    </div> <!-- container -->

    <div class="modal fade" id="isirel" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Penilaian Realisasi SKP <span id="jmrpb"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-2">

                        <div class="col-sm-8">
                            <div class="float-sm-left">
                                <button type="button" class="btn btn-info btn-sm waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Belum
                                    Dinilai
                                </button>
                                <button type="button" class="btn btn-success btn-sm waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Telah
                                    Dinilai
                                </button>
                            </div>
                        </div><!-- end col-->
                        <div class="col-sm-4">
                            <div class="float-sm-right ">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#kriteria"
                                    class="btn btn-warning btn-sm mb-2"><i class="mdi mdi-plus-circle "></i> Kriteria
                                    Penilaian</a>
                            </div>

                        </div>
                    </div>
                    <div class="px-1 ">
                        <form id="submitisi">
                            <div class="table-responsive">
                                <table id="tabelisi"
                                    class="table table-hover text-dark dt-responsive nowrap table-sm table-bordered">


                                </table>
                            </div>
                            <button class="d-none" type="submit"></button>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" id="svsbmt" class="btn btn-primary">
                        <span id="svsbmt1" class="spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        <span id="svsbmt2">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="isirelt" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Penilaian Tugas Tambahan <span id="jmrpb"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-2">

                        <div class="col-sm-8">
                            <div class="float-sm-left">
                                <button type="button" class="btn btn-info btn-sm waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Belum
                                    Dinilai
                                </button>
                                <button type="button" class="btn btn-success btn-sm waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-alert-circle-outline"></i></span>Telah
                                    Dinilai
                                </button>
                            </div>
                        </div><!-- end col-->
                        <div class="col-sm-4">
                            <div class="float-sm-right ">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#kriteria"
                                    class="btn btn-warning btn-sm mb-2"><i class="mdi mdi-plus-circle "></i> Kriteria
                                    Penilaian</a>
                            </div>

                        </div>
                    </div>
                    <div class="px-1 ">
                        <form id="submitisit">
                            <div class="table-responsive">
                                <table id="tabelisit"
                                    class="table table-hover text-dark dt-responsive nowrap table-sm table-bordered">


                                </table>
                            </div>
                            <button class="d-none" type="submit"></button>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" id="svsbmtt" class="btn btn-primary">
                        <span id="svsbmt1t" class="spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        <span id="svsbmt2t">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>
    <div id="kriteria" class="modal fade shadow-lg" tabindex="-1" role="dialog"
        style="background:
                                                                                                                                        rgba(0,0,0,0.2);" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Kriteria Penilaian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="w-25 text-center" scope="col">Kriteria Nilai</th>
                                <th class="w-75 text-center" scope="col">Keterangan</th>

                            </tr>
                        </thead>
                        <tbody class="tdk">
                            <tr>
                                <th scope="row">91 - 100</th>
                                <td>Hasil kerja sempurna, dan pelayanan di atas tidak ada kesalahan, tidak ada revisi,
                                    standar yang ditentukan dan lain-lain.
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">76 - 90 </th>
                                <td>Hasil kerja mempunyai 1 (satu) atau 2 (dua) kesalahan kecil, tidak ada kesalahan besar,
                                    revisi, dan pelayanan sesuai standar yang telah ditentukan dan lain-lain.
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">61 - 75 </th>
                                <td>Hasil kerja mempunyai 3 (tiga) atau 4 (empat) kesalahan kecil, dan tidak ada kesalahan
                                    besar, revisi, dan pelayanan cukup memenuhi standar yang ditentukan dan lain-lain.

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">51 - 60 </th>
                                <td>Hasil kerja mempunyai 5 (lima) kesalahan kecil dan ada kesalahan besar, revisi, dan
                                    pelayanan tidak cukup memenuhi standar yang ditentukan dan lain-lain.

                                </td>
                            </tr>
                            <tr>
                                <th scope="row">50 ke Bawah </th>
                                <td>Hasil kerja mempunyai lebih dari 5 (lima) kesalahan kecil dan ada kesalahan besar,
                                    kurang memuaskan, revisi, pelayanan di bawah standar yang ditentukan dan lain-lain.

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="lihatlog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Log Harian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm  " style="width: 100%;" id="itemlog"
                            style="border-collapse: collapse; border-spacing: 0;">
                            <thead>

                                <tr>

                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Tanggal Input</th>

                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Output</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="lihatgambar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Foto Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">

                            <img class="tzey" alt="">
                        </div>
                        <div class="col-md-6">
                            <label for="">Keterangan</label>
                            <p id="ketnya"></p>
                        </div>
                    </div>
                </div>
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

        function lg(img) {
            console.log(img);
            $("#lihatgambar").modal('show');
            $('.tzey').attr("src", url + '/image/log/' + img.gambar);
            $("#ketnya").html(img.ket);
            console.log(url + '/image/log/' + img.gambar);
        }

        function lihatlogs(a, b) {
            $("#lihatlog").modal('show');

            if ($.fn.DataTable.isDataTable('#itemlog')) {
                $("#itemlog").DataTable().destroy();

            }
            tabellog = $("#itemlog").DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "1%",
                    },
                    {
                        orderable: false,
                        targets: 3,
                        width: "50%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "10%",

                    },
                    {
                        orderable: false,
                        targets: 4,
                        width: "6%",

                    }, {
                        orderable: false,
                        targets: 5,
                        width: "5%",

                    },


                    {
                        targets: 1,
                        width: "8%",

                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('logharian.targets') }}",
                    data: {
                        id: a,
                        bul: b
                    }
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    },
                    {
                        name: 'tanggal',
                        data: 'tanggal'
                    }, {
                        name: 'inputtgl',
                        data: 'inputtgl'
                    }, {
                        name: 'kegiatan',
                        data: 'kegiatan',
                        className: 'text-left'
                    },
                    {
                        name: 'output',
                        data: 'output'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi'
                    },


                ]
            });
        }
        $("#rk").on('click', function() {
            $(".details-control").trigger('click');
        });
        $("#svsbmt").on('click', function() {
            $("#submitisi").trigger('submit');
        })
        $("#svsbmtt").on('click', function() {
            $("#submitisit").trigger('submit');
        })
        $("#submitisi").on('submit', function(e) {

            $("#svsbmt").attr('disabled', 'true');
            $("#svsbmt2").html('Simpan...')
            $("#svsbmt1").addClass('spinner-border ');
            e.preventDefault();
            var data = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('penilaian-realisasi.store') }}",
                type: 'post',
                data: data,
                success: function(e) {
                    $("#toastr-three").trigger("click");
                    $("#svsbmt").removeAttr('disabled');
                    $("#svsbmt2").html('Simpan');
                    $("#svsbmt1").removeClass('spinner-border ');
                    console.log(e)
                    tabel.ajax.reload();
                }
            });
        })
        $("#submitisit").on('submit', function(e) {

            $("#svsbmtt").attr('disabled', 'true');
            $("#svsbmt2t").html('Simpan...')
            $("#svsbmt1t").addClass('spinner-border ');
            e.preventDefault();
            var data = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('penilaian-realisasi.storetugas') }}",
                type: 'post',
                data: data,
                success: function(e) {
                    $("#toastr-three").trigger("click");
                    $("#svsbmtt").removeAttr('disabled');
                    $("#svsbmt2t").html('Simpan');
                    $("#svsbmt1t").removeClass('spinner-border ');
                    console.log(e)
                    tabel.ajax.reload();
                }
            });
        })

        function reset(id, bul) {
            $.ajax({
                url: "{{ route('penilaian-realisasi.reset') }}",
                type: 'post',
                data: {
                    id: id,
                    bul: bul
                },
                success: function(e) {
                    console.log(e);
                    tabel.ajax.reload();

                }
            });
        }

        function nilai(id, bul) {
            $.ajax({
                url: "{{ route('penilaian-realisasi.isi') }}",
                type: 'post',
                data: {
                    id: id,
                    bul: bul
                },
                success: function(e) {
                    $("#tabelisi").html(e);

                }
            });
            $("#isirel").modal('show');
        }

        function nilait(id, bul) {
            $.ajax({
                url: "{{ route('penilaian-realisasi.tugas') }}",
                type: 'post',
                data: {
                    id: id,
                    bul: bul
                },
                success: function(e) {
                    $("#tabelisit").html(e);
                }
            });
            $("#isirelt").modal('show');
        }
        $("#selectbulan").on('change', function(e) {
            let id = $(this).val();
            e.preventDefault();
            console.log(id);
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
                url: url + '/skp/penilaian-realisasi/' + id,
                type: 'get',
                success: function(e) {
                    $("#kegiatan").val(e.tugasjabatan);
                    $("#aktivitas").val(e.kegiatan);
                    $("#targetkuantitas").val(e.tkuantitas);
                    $("#skuan").html(e.satuan);
                    $("#rkuan").html(e.satuan);
                    $("#idtugas").val(id);
                    $("#realisasikualitas").attr("max", e.tkuantitas);

                    console.log(e)
                }
            })
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        tabel = $("#penilaian").DataTable({
            "dom": "<'row'<'col-sm-6'<'row'<'pl-2 toolbar'><'col-sm-6'l>>><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            fnInitComplete: function() {
                let html = '<select id="ts" class="form-control form-control-sm">' +
                    '<option selected value="none">Pilih Status </option>' +
                    '<option value="2022" > 2022 </option>' +


                    '</select>';
                $('div.toolbar').html(html);
                $("#ts").change(function(e) {

                });

            },
            columnDefs: [{
                    orderable: false,
                    targets: 0,
                    width: "1%",
                },
                {
                    orderable: false,
                    targets: 3,
                    width: "20%",

                },

                {
                    orderable: false,
                    targets: 4,
                    width: "5%",

                },
                {
                    orderable: false,
                    targets: 2,
                    width: "20%",


                },
                {
                    orderable: false,
                    targets: 5,
                    width: "5%",

                },
                {
                    orderable: false,
                    targets: 6,
                    width: "1%",

                }, {
                    orderable: false,
                    targets: 7,
                    width: "20%",

                },

                {
                    targets: 1,
                    width: "15%",
                    orderable: false,

                }
            ],

            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('penilaian-realisasi.bulan') }}",
                type: "post"
            },
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'nip',
                    data: 'nip'
                }, {
                    nama: 'nama',
                    data: 'nama'
                }, {
                    nama: 'jabatan',
                    data: 'jabatan'
                },
                {
                    nama: 'status_target',
                    data: 'status_target'
                },
                {
                    nama: 'nilaia',
                    data: ({
                        nilaia
                    }) => parseFloat(Number(nilaia)).toFixed(2)
                }, {
                    nama: 'nilait',
                    data: ({
                        nilait
                    }) => parseFloat(Number(nilait)).toFixed(2)
                }, {
                    nama: 'aksi',
                    data: 'aksi'
                },


            ]
        });
        $("#subtar").submit(function(e) {
            e.preventDefault();
            $("#btnsf").attr('disabled', 'true');
            $("#btnsf2").html('Simpan...')
            $("#btnsf1").addClass('spinner-border ');
            let data = $(this).serialize();
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('penilaian-realisasi.store') }}",
                data: data,
                type: 'post',
                success: function(e) {
                    $("#btnsf").removeAttr('disabled');
                    $("#btnsf2").html('Simpan');
                    $("#btnsf1").removeClass('spinner-border ');
                    $("#toastr-three").trigger("click");
                    $("#realisasikualitas").val('');
                    $("#rkualitas").val('');
                    $("#keterangan").val('');
                    console.log(e);
                    tabel.ajax.reload();
                }
            })
        });

        function loghariani(id) {
            $("#lihatlog").modal('show');

            console.log(id);
            if ($.fn.DataTable.isDataTable('#itemlog')) {
                $("#itemlog").DataTable().destroy();

            }
            tabellog = $("#itemlog").DataTable({
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "1%",
                    },
                    {
                        orderable: false,
                        targets: 3,
                        width: "50%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "10%",

                    },
                    {
                        orderable: false,
                        targets: 4,
                        width: "6%",

                    }, {
                        orderable: false,
                        targets: 5,
                        width: "5%",

                    },


                    {
                        targets: 1,
                        width: "8%",

                    }
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('logharian.target') }}",
                    data: {
                        id: id,
                    }
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    },
                    {
                        name: 'tanggal',
                        data: 'tanggal'
                    }, {
                        name: 'inputtgl',
                        data: 'inputtgl'
                    }, {
                        name: 'kegiatan',
                        data: 'kegiatan',
                        className: 'text-left'
                    },
                    {
                        name: 'output',
                        data: 'output'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi'
                    },


                ]
            });
        }

        function badge(id) {
            if (id == 0) {
                return '<h4 class="badge badge-warning"> Belum Melakukan penilaian</h4>'
            } else if (id == 1) {
                return '<h4 class="badge badge-info"> Menunggu Penilaian Atasan</h4>'
            } else {
                return '<h4 class="badge badge-success">Telah Dinilai</h4>'
            }
        }

        function checktheme(id) {
            if (id == 0 || id == 1) {
                return 'table-info'
            } else {
                return 'table-success'
            }
        }



        $(document).ready(function() {

            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log(message);
            };



        });
    </script>
@endpush
