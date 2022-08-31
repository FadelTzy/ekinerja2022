@extends('user.index')

@section('cssc')
    <link href="{{ asset('minton/assets/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('minton/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        td.details-control {
            background: url('{{ asset('img/open.png') }}') no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url('{{ asset('img/close.png') }}') no-repeat center center;
        }

    </style>
@endsection

@section('body')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box page-title-box-alt">
                        <h4 class="page-title">SKP {{ $period->nama_periode }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">SKP Periode</a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if ($jab != 'kosong')
                @if (!Session::has('period'))
                    <div class="row">
                        <div class="col-12">
                            <div class=" alert alert-danger ">
                                <h4 class="page-title">Periode Belum Diset</h4>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            @if ($jab->status_target == 0)
                                <div class="d-flex justify-content-between alert alert-danger ">
                                    <h4 class="page-title">Anda Belum Menyusun Target Semester
                                        {{ $period->nama_periode }} </h4>
                                </div>
                            @elseif($jab->status_target == 1)
                                <div class=" alert alert-success ">
                                    <h4 class="page-title">Target Semester Telah Disetujui {{ $period->nama_periode }}
                                    </h4>
                                </div>
                            @elseif($jab->status_target == 4)
                                <div class=" alert alert-success ">
                                    <h4 class="page-title">SKP {{ $period->nama_periode }} Telah Dinilai
                                    </h4>
                                </div>
                            @elseif($jab->status_target == 2)
                                <div class="alert alert-warning d-flex justify-content-between">
                                    <h4 class="page-title">Target Semester Di Tolak, Silahkan Menyusun Ulang
                                        {{ $period->nama_periode }} </h4>
                                    <div>

                                        <button class="btn btn-soft-warning" type="button" data-toggle="modal"
                                            data-target="#standard-modal"><i class="mdi mdi-alert"></i></button>
                                        <button type="button" onclick="keanu()" class="btn  btn-warning"> Edit Target
                                        </button>
                                    </div>
                                </div>
                            @elseif($jab->status_target == 3)
                                <div class=" alert alert-primary ">
                                    <h4 class="page-title">Menunggu Persetujuan Target Semester, Silahkan Menghubungi
                                        Atasan</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 d-flex mb-2">
                                            {{-- <a type="button" href="{{ route('skp.index') }}"
                                                class="btn btn-sm btn-bordered-danger waves-effect waves-light"><i
                                                    class="mdi mdi-arrow-left mr-1"></i> Kembali</a> --}}
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"> <span class="btn-label"><i
                                                            class="fas fa-angle-down"></i></span>
                                                    Cetak Rencana
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" target="_blank"
                                                        href="{{ route('cetak.rskp') }}">Rencana SKP</a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end">
                                            <a href="{{ route('tugas-tambahan.index') }}" type="button"
                                                class="btn btn-sm btn-warning mb-2 mr-1">Tugas
                                                Tambahan</a>
                                            <button id="rk" type="button" class="btn btn-sm btn-primary mb-2 mr-1">Rincian
                                                Kegiatan</button>
                                            <button type="submit" id="tambahtupok" data-toggle="modal"
                                                data-target="#full-width-modal" class="btn btn-sm btn-primary mb-2 mr-1"><i
                                                    class="mdi mdi-plus mr-1"></i>Tambah</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table table-hover table-bordered table-sm table-centered w-100 dt-responsive"
                                            id="semester"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                {{-- <tr>
                                                    <th rowspan="2">#</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
        
                                                </tr> --}}
                                                <tr class="">
                                                    <th>#</th>
                                                    <th></th>
                                                    <th>Kinerja Utama</th>
                                                    <th>Total Rencana Kerja</th>
                                                    <th>Rencana Kerja</th>
                                                    <th>Aksi</th>
                                                </tr>

                                            </thead class>

                                        </table>
                                    </div>
                                </div>

                            </div> <!-- end card -->
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                @endif
            @else
                <div class="row">
                    <div class="col-12">
                        <div class=" alert alert-danger ">
                            <h4 class="page-title">Tugas Jabatan Anda Untuk {{ $period->nama_periode }} Tidak
                                Terdaftar
                            </h4>
                        </div>
                    </div>
                </div>
            @endif





        </div> <!-- container -->

    </div> <!-- content -->

    <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Kinerja Utama</h4>
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
                                        <textarea class="form-control" name="kinerja" required id="kinerja" placeholder="Input kinerja" cols="20"
                                            rows="6"></textarea>
                                    </div>
                                    <span>
                                        <p><i>*Kinerja utama adalah rangkuman dari seluruh aktifitas rencana kinerja</i>
                                        </p>
                                    </span>
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
    <div id="full-width-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Kinerja Utama</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="post" id="subtare" action="#">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" id="idt" name="idu">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="kinerja" required id="kinerjau" placeholder="Tugas" cols="20"
                                            rows="5"></textarea>
                                    </div>

                                </div>

                                <button type="submit" id="btnsfu" class="btn btn-primary">
                                    <span id="btnsf1u" class="spinner-border-sm mr-1" role="status"
                                        aria-hidden="true"></span>
                                    <span id="btnsf2u">Simpan</span>
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
@endsection

@push('js')
    <script src="{{ asset('minton/assets/libs/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $("#rk").on('click', function() {
            $(".details-control").trigger('click');
        })
        let url = window.location.origin;
        var tabel;
        $("#subtare").on('submit', function(e) {
            e.preventDefault();
            $("#btnsfu").attr('disabled', 'true');
            $("#btnsf2u").html('Simpan...')
            $("#btnsf1u").addClass('spinner-border ');
            id = $("#idt").val();
            let data = $(this).serialize();
            $.ajax({
                url: url + '/skp/rancangan/kinerja-utama/' + id,
                data: data,
                type: 'PUT',
                success: function(e) {
                    $("#btnsfu").removeAttr('disabled');
                    $("#btnsf2u").html('Simpan');
                    $("#btnsf1u").removeClass('spinner-border ');
                    $("#toastr-three").trigger("click");

                    console.log(e);
                    tabel.ajax.reload();
                }
            })
        })

        function editj(e) {
            e.preventDefault;
            console.log(e);
            $("#full-width-modal2").modal('show')
            $("#idt").val(e.id);

            $("#kinerjau").val(e.rencana);
        }

        function delj(e) {
            e.preventDefault;

            $data = confirm("klik oke untuk melanjutkan");
            if ($data == 1) {
                $('.loader').modal('show');
                let iddel = e;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url + '/skp/rancangan/kinerja-utama/' + e,
                    type: 'DELETE',
                    success: function(e) {
                        if (e == 'suc') {
                            $("#delete-success").trigger("click");
                        } else if (e == 'err') {
                            $("#delete-wrong").trigger("click");
                        }

                        tabel.ajax.reload(function() {
                            $('.loader').modal('hide');
                        });
                    },
                    error: function(e) {
                        console.log(e);
                    }

                })
                console.log(iddel);
                tabel.ajax.reload();
            }

        }

        function copy(item, id) {
            $("#kegiatan").val(item);
            $("#aktivitas").val(item);
            $("#idtugas").val(id);
        }

        function copyu(item, id) {
            $("#kegiatanu").val(item);
            $("#aktivitasu").val(item);
            $("#idtugasu").val(id);
        }

        function format(d) {
            // `d` is the original data object for the row
            console.log(d);
            var el = document.createElement('html');
            el.innerHTML = d.ket;

            el.getElementsByTagName('a');
            return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
        <tr>
            <td>Aktivitas:</td>
            <td>${d.kegiatan}</td>
            </tr>
            <tr>
            <td>Keterangan:</td>
            <td class='ales'>${d.ket}</td>
            </tr>
            </table>`;
        }

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

                arrs = arrs + '<tr class="table-info">' + '<td class="text-center" rowspan="3" colspan="2"><b>' +
                    no++
                    +
                    '</b></td>' +
                    '<td class="text-left" rowspan="3" colspan="1"><b>' + element["kegiatan"] + '</b></td>' +
                    '<td class="text-left"  colspan="1"><b>' + 'Kuantitas' +
                    '</b></td>' + '<td class="text-left" colspan="1"><b>' + element["ikikuantitas"] +
                    '</b></td>' +
                    '<td class="text-left" colspan="1"><b>' + element["tkuantitas"] + ' - ' + element[
                        "tkuantitasmax"] + ' ' + element["satuan"]
                '</b></td>' +
                '</tr>';

                arrs = arrs + '<tr class="table-info">' +
                    '<td class="text-left" colspan="1"><b>' + 'Kualitas' +
                    '</b></td>' + '<td class="text-left" colspan="1"><b>' + element["ikikualitas"] +
                    '</b></td>' +
                    '<td class="text-left" colspan="1"><b>' + element["tkualitas"] + ' - ' + element[
                        "tkualitasmax"] + ' ' + element["satuankualitas"]
                '</b></td>' +
                '</tr>';
                arrs = arrs + '<tr class="table-info">' +
                    '<td class="text-left" colspan="1"><b>' + 'Waktu' +
                    '</b></td>' + '<td class="text-left" colspan="1"><b>' + element["ikiwaktu"] +
                    '</b></td>' +
                    '<td class="text-left" colspan="1"><b>' + element["twaktu"] + ' - ' + element[
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
        $(document).ready(function(e) {
            $('#keterangan').summernote({
                placeholder: 'Input Text',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('#keteranganu').summernote({
                placeholder: 'Input Text',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.log(message);
            };
            tabel = $("#semester").DataTable({

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
                    url: "{{ route('kinerja-utama.create') }}",
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
                        data: 'aksi'
                    },


                ]
            });


            $('#semester tbody').on('click', 'td.details-control', function() {
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

        $("#subtar").submit(function(e) {
            e.preventDefault();
            $("#btnsf").attr('disabled', 'true');
            $("#btnsf2").html('Simpan...')
            $("#btnsf1").addClass('spinner-border ');
            let data = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('kinerja-utama.store') }}",
                data: data,
                type: 'post',
                success: function(e) {
                    $("#btnsf").removeAttr('disabled');
                    $("#btnsf2").html('Simpan');
                    $("#btnsf1").removeClass('spinner-border ');
                    $("#toastr-three").trigger("click");
                    // $("#kuantitas").val('');
                    // $("#kegiatan").val('');
                    // $("#kualitas").val('');
                    // $("#aktivitas").val('');
                    // $("#bulan").val('');
                    // $("#keterangan").val('');
                    // $("#satuan").val('');
                    console.log(e);
                    tabel.ajax.reload();
                }
            })
        });
    </script>
@endpush
