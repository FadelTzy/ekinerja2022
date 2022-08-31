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



            <div class="row">

                <div class="col-xl-12">
                    <div class="alert alert-success" role="alert">
                        <i class="mdi mdi-check-all mr-2"></i> <strong>Kinerja Utama</strong>
                        <p>{{ $daker->rencana }}</p>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 mb-2">
                                    <a type="button" href="{{ route('kinerja-utama.create') }}"
                                        class="btn btn-sm btn-bordered-danger waves-effect waves-light"><i
                                            class="mdi mdi-arrow-left mr-1"></i> Kembali</a>
                                </div>
                                <div class="col-sm-9 text-right">
                                    <button type="submit" id="tambahtupok" data-toggle="modal"
                                        data-target="#full-width-modal"
                                        class="btn btn-sm btn-bordered-primary waves-effect waves-light"><i
                                            class="mdi mdi-plus mr-1"></i>Tambah</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-sm table-centered w-100 dt-responsive" id="semester"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2">#</th>
                                            <th rowspan="2"></th>

                                            <th rowspan="2">Tugas</th>

                                            <th colspan="3">Target</th>
                                            <th rowspan="2">Aksi</th>

                                        </tr>
                                        <tr class="text-center">
                                            <th scope="col">Kuantitas</th>
                                            <th scope="col">Kualitas</th>
                                            <th scope="col">Waktu</th>

                                        </tr>
                                    </thead class>

                                </table>
                            </div>
                        </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->

    <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Target Rencana Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" id="subtar" action="#">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" id="idrencana" value="{{ $id }}" name="idrencana">

                                    <input type="hidden" id="idtugas" name="idtugas">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Tugas Jabatan</label>
                                        <textarea class="form-control" name="kegiatan" required id="kegiatan" readonly placeholder="Tugas" cols="20"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail1">Rencana Kinerja</label>
                                        <textarea class="form-control" name="aktivitas" required id="aktivitas" placeholder="Kegiatan" cols="20"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table-sm table mb-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 8%">Aspek</th>
                                                    <th rowspan="2" style="width: 50%">IKI</th>
                                                    <th style="width:25%" colspan="2">Target</th>
                                                    <th style="width:20%" rowspan="2">Satuan</th>
                                                </tr>
                                                <tr>
                                                    <th>Min</th>
                                                    <th>Max</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Kuantitas</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikikuantitas" required id="ikikuantitas" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="kuantitasmin"
                                                            id="kuantitasmin" placeholder="Enter text.."></td>
                                                    <td><input type="text" class="form-control" name="kuantitasmax"
                                                            id="kuantitasmax" placeholder="Enter text.."></td>
                                                    <td><select name="satuankuantitas" class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option value="Dokumen">Dokumen</option>
                                                            <option value="Surat">Surat</option>
                                                            <option value="PNS">PNS</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Kualitas</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikikualitas" id="ikikualitas" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="kualitasmin"
                                                            id="kualitasmin" value="90%" placeholder="%"></td>
                                                    <td><input type="text" class="form-control" name="kualitasmax"
                                                            id="kualitasmax" value="100%" placeholder="%"></td>
                                                    <td><select name="satuankualitas" class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option selected value="Sesuai">Sesuai</option>

                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Waktu</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikiwaktu" required id="ikiwaktu" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="waktumin"
                                                            id="waktumin" placeholder="Enter"></td>
                                                    <td><input type="text" class="form-control" name="waktumax"
                                                            id="waktumax" placeholder="Enter"></td>
                                                    <td><select name="satuanwaktu" class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option value="Bulan">Bulan</option>
                                                            <option value="Hari">Hari</option>
                                                            <option value="Jam">Jam</option>
                                                        </select></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label for="kuantitas">Kuantitas</label>
                                        <input type="text" class="form-control" required name="kuantitas" id="kuantitas"
                                            placeholder="Kuantitas">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" class="form-control" name="satuan" id="satuan"
                                            placeholder="Laporan">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option disabled selected>Pilih Bulan</option>
                                            @foreach ($smst as $s)
                                                <option value="{{ $s->no }}">{{ $s->bulan }}</option>
                                            @endforeach



                                        </select>
                                    </div> --}}
                                    <div class="form-group col-md-12">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" cols="20"
                                            rows="5"></textarea>
                                    </div>
                                </div>

                                <button type="submit" id="btnsf" class="btn btn-primary">
                                    <span id="btnsf1" class="spinner-border-sm mr-1" role="status"
                                        aria-hidden="true"></span>
                                    <span id="btnsf2">Simpan</span>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-centered " style="width: 100%;" id="item"
                                    style="border-collapse: collapse; border-spacing: 0;">
                                    <thead>

                                        <tr>
                                            <th style="width: 80%;" scope="col">Item</th>
                                            <th style="width: 10%;" scope="col">Copy</th>
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
    <div id="full-width-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Target Rencana Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" id="subtare" action="#">
                                @csrf
                                <div class="form-row">
                                    <input type="hidden" id="idtugasu" name="idtugasu">
                                    <input type="hidden" id="idt" name="idu">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Tugas Jabatan</label>
                                        <textarea class="form-control" name="kegiatanu" required id="kegiatanu" readonly placeholder="Tugas" cols="20"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail1">Rencana Kerja</label>
                                        <textarea class="form-control" name="aktivitasu" required id="aktivitasu" placeholder="Kegiatan" cols="20"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table-sm table mb-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="width: 8%">Aspek</th>
                                                    <th rowspan="2" style="width: 50%">IKI</th>
                                                    <th style="width:25%" colspan="2">Target</th>
                                                    <th style="width:20%" rowspan="2">Satuan</th>
                                                </tr>
                                                <tr>
                                                    <th>Min</th>
                                                    <th>Max</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Kuantitas</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikikuantitas" required id="ikikuantitasu" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="kuantitasmin"
                                                            id="kuantitasminu" placeholder="Enter text.."></td>
                                                    <td><input type="text" class="form-control" name="kuantitasmax"
                                                            id="kuantitasmaxu" placeholder="Enter text.."></td>
                                                    <td><select id="satuankuantitasu" name="satuankuantitas"
                                                            class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option value="Dokumen">Dokumen</option>
                                                            <option value="Surat">Surat</option>
                                                            <option value="PNS">PNS</option>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Kualitas</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikikualitas" id="ikikualitasu" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="kualitasmin"
                                                            id="kualitasminu" value="90%" placeholder="%"></td>
                                                    <td><input type="text" class="form-control" name="kualitasmax"
                                                            id="kualitasmaxu" value="100%" placeholder="%"></td>
                                                    <td><select id="satuankualitasu" name="satuankualitas"
                                                            class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option selected value="Sesuai">Sesuai</option>

                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Waktu</th>
                                                    <td>
                                                        <textarea class="form-control" name="ikiwaktu" required id="ikiwaktuu" placeholder="Enter text" cols="20"
                                                            rows="2"></textarea>
                                                    </td>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="waktumin"
                                                            id="waktuminu" placeholder="Enter"></td>
                                                    <td><input type="text" class="form-control" name="waktumax"
                                                            id="waktumaxu" placeholder="Enter"></td>
                                                    <td><select id="satuanwaktuu" name="satuanwaktu" class="custom-select">
                                                            <option disabled selected="">Satuan</option>
                                                            <option value="Bulan">Bulan</option>
                                                            <option value="Hari">Hari</option>
                                                            <option value="Jam">Jam</option>
                                                        </select></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keteranganu" required id="keteranganu" placeholder="Keterangan" cols="20"
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
                        <div class="col-md-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-centered " style="width: 100%;" id="item2"
                                    style="border-collapse: collapse; border-spacing: 0;">
                                    <thead>

                                        <tr>

                                            <th style="width: 80%;" scope="col">Item</th>
                                            <th style="width: 20%;" scope="col">Copy</th>
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
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>
@endsection

@push('js')
    <script src="{{ asset('minton/assets/libs/summernote/summernote-bs4.min.js') }}"></script>
    <script>
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
                url: url + '/skp/rancangan/kinerja-utama/skp/edit/' + id,
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
            $("#idtugasu").val(e.id_tup);
            $("#kegiatanu").val(e.tt);

            $("#kuantitasminu").val(e.tkuantitas);
            $("#kuantitasmaxu").val(e.tkuantitasmax);

            $("#kualitasminu").val(e.tkualitas);
            $("#kualitasmaxu").val(e.tkualitasmax);

            $("#waktuminu").val(e.twaktu);
            $("#waktumaxu").val(e.twaktumax);

            $("#ikikuantitasu").val(e.ikikuantitas);
            $("#ikikualitasu").val(e.ikikualitas);
            $("#ikiwaktuu").val(e.ikiwaktu);

            $("#aktivitasu").val(e.kegiatan);
            $("#keteranganu").summernote("code", e.ket);
            $("#satuankuantitasu option[value=" + e.satuan + "]").attr('selected', 'selected');
            $("#satuankualitasu option[value=" + e.satuankualitas + "]").attr('selected', 'selected');
            $("#satuanwaktuu option[value=" + e.satuanwaktu + "]").attr('selected', 'selected');

            $("#kuantitasu").val(e.tkuantitas);
            $("#satuanu").val(e.satuan);
            let tabel3 = $("#item2").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('skp.itemu') }}"
                },
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "95%",
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: "5%",

                    },

                ],
                columns: [{
                        nama: 'uraian',
                        data: 'uraian'
                    }, {
                        nama: 'aksii',
                        data: 'aksii'
                    },

                ]
            });
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
                    url: url + '/skp/rancangan/skp/' + e,
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
            <td>IKI Kuantitas:</td>
            <td>:</td>

            <td>${d.ikikuantitas}</td>
            </tr>
            <tr>
            <td>IKI Kualitas</td>
            <td>:</td>

            <td class='ales'>${d.ikikualitas}</td>
            </tr>
            <tr>
            <td>IKI Waktu</td>
            <td>:</td>

            <td class='ales'>${d.ikiwaktu}</td>
            </tr>
            <tr>
            <td>Keterangan</td>
            <td>:</td>

            <td class='ales'>${d.ket}</td>
            </tr>
            </table>`;
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
            let tabel2 = $("#item").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('skp.item') }}"
                },
                columnDefs: [{
                        orderable: false,
                        targets: 0,
                        width: "95%",
                    },
                    {
                        orderable: false,
                        targets: 1,
                        width: "5%",

                    },

                ],
                columns: [{
                        nama: 'uraian',
                        data: 'uraian'
                    }, {
                        nama: 'aksii',
                        data: 'aksii'
                    },

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
                        orderable: false,
                        targets: 3,
                        width: "10%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "35%",

                    },
                    {
                        orderable: false,
                        targets: 4,
                        width: "13%",

                    },
                    {
                        orderable: false,
                        targets: 5,
                        width: "7%",

                    },
                    {
                        orderable: false,
                        targets: 6,
                        width: "12%",

                    },
                    {
                        targets: 1,
                        width: "1%",
                        orderable: false,

                    }
                ],
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('skp/rancangan/kinerja-utama/create/') . '/' . $id }}",
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
                        nama: 'tkuan',
                        data: 'tkuan'
                    }, {
                        nama: 'tkual',
                        data: 'tkual'
                    }, {
                        nama: 'twaktu',
                        data: 'twaktu'
                    },
                    {
                        nama: 'aksi',
                        data: 'aksi'
                    },


                ]
            });
            $('#semester tbody').on('click', 'td.details-control', function() {
                console.log('as')
                var tr = $(this).closest('tr');
                var row = tabel.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
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
                url: "{{ route('kinerja-utama.storeskp') }}",
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
