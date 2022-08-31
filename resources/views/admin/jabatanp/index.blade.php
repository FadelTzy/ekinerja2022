@extends('admin.ds_index')

@section('cssc')
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

    </style>
@endsection
@section('breadcrumb')
    <h4 class="page-title">Tabel Jabatan</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
            <li class="breadcrumb-item active"><a href="javascript: void(0);">Jabatan</a></li>
        </ol>
    </div>
@endsection

@section('body')
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div>
                    <form id="tambah_jab" method="POST" action="#">
                        @csrf
                        <div class="modal-body py-2 px-3">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-2">
                                        <div class="form-group">
                                            <label for="jabatan" class="control-label">Jabatan</label>

                                            <input type="text" name="jabatan" required placeholder="Input Jabatan"
                                                id="jabatan" class="form-control">

                                        </div>
                                    </div>
                                </div>

                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button id="rem_s" class="btn btn-success waves-effect waves-light">
                                <span id="spin" class="spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                <span id="textb">Simpan</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="con-close-modalu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Jabatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div>
                    <form id="tambah_jabu" method="POST" action="#">
                        @csrf
                        <div class="modal-body py-2 px-3">
                            <input type="hidden" name="id" id="idu">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-2">
                                        <div class="form-group">
                                            <label for="jabatan" class="control-label">Jabatan</label>

                                            <input type="text" id="jabatanu" name="jabatan" required
                                                placeholder="Input Jabatan" id="jabatan" class="form-control">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            <button id="rem_su" class="btn btn-success waves-effect waves-light">
                                <span id="spinu" class="spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                                <span id="textbu">Simpan</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h4 class="header-title">Data Jabatan</h4>
                            <p class="text-muted font-13 ">
                                DataTables has most features enabled by default, so all you need to do to use it with your
                                own tables is to call the construction
                                function:
                                <code>$().DataTable();</code>.
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <div class="float-sm-right">

                                <button class="btn btn-success btn-sm waves-effect waves-light mb-2" id="con-open"
                                    data-toggle="modal" data-target="#con-close-modal"><i
                                        class="mdi mdi-plus-circle mr-1"></i> Tambah Data</button>

                            </div>
                        </div><!-- end col-->
                    </div>
                    <!-- end row -->
                    <!-- tes -->
                    <div id="tabelpos" class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive" id="products-datatable2"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                                <tr>

                                    <th>No</th>
                                    <th>Jabatan</th>
                                    <th>Total Jenjang</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>

    <div class="modal loader fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width: 48px">
                <span class="fa fa-spinner fa-spin fa-3x"></span>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var sinkron;
        var tabel;
        var url = window.location.origin;

        $("#tambah_jab").submit(function(e) {

            e.preventDefault();

            var data = $(this).serialize();
            console.log(data);
            $("#rem_s").attr('disabled', 'true');
            $("#textb").html('Simpan...')
            $("#spin").addClass('spinner-border ');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('jabatan_p.store') }}",
                type: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                    $("#rem_s").removeAttr('disabled');
                    $("#textb").html('Simpan');
                    $("#spin").removeClass('spinner-border ');
                    if (response.error != null) {
                        $("#toastr-one").trigger("click");
                        $("#errr").html(
                            '<label class="text-danger"><i>*Field Belum Diset</i></label> <br />');
                        console.log(response);
                    }
                    if (response.success) {
                        $("#statuserr,#kstatuserr").html('');
                        $("#toastr-three").trigger("click");
                        $("#errr").html('');
                        console.log('success');
                        $(".vk").val('');
                        tabel.ajax.reload();
                        $("#con-close-modal").modal('hide');
                    }

                },
                error: function(response) {
                    console.log(response);
                    $("#rem_s").removeAttr('disabled');
                    $("#textb").html('Simpan');
                    $("#spin").removeClass('spinner-border ');
                    $("#toastr-one").trigger("click");

                },
            });

        });
        $("#tambah_jabu").submit(function(e) {

            e.preventDefault();

            var data = $(this).serialize();
            var id = $("#idu").val();
            console.log(data);
            $("#rem_su").attr('disabled', 'true');
            $("#textbu").html('Simpan...')
            $("#spinu").addClass('spinner-border ');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url + '/admin/dm/jabatan_p/' + id,
                type: "PUT",
                data: data,
                success: function(response) {
                    console.log(response);
                    $("#rem_su").removeAttr('disabled');
                    $("#textbu").html('Simpan');
                    $("#spinu").removeClass('spinner-border ');
                    if (response.error != null) {
                        $("#toastr-one").trigger("click");
                        $("#errr").html(
                            '<label class="text-danger"><i>*Field Belum Diset</i></label> <br />');
                        console.log(response);
                    }
                    if (response.success) {
                        $("#statuserr,#kstatuserr").html('');
                        $("#toastr-three").trigger("click");
                        $("#errr").html('');
                        console.log('success');
                        $(".vk").val('');
                        tabel.ajax.reload();
                        $("#con-close-modalu").modal('hide');
                    }

                },
                error: function(response) {
                    console.log(response);
                    $("#rem_su").removeAttr('disabled');
                    $("#textbu").html('Simpan');
                    $("#spinu").removeClass('spinner-border ');
                    $("#toastr-one").trigger("click");

                },
            });

        });

        function deletej(id) {

            let d = confirm("Klik Oke Untuk Melanjutkan")
            if (d) {
                $('.loader').modal('show');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url + '/admin/dm/jabatan_p/' + id,
                    type: 'DELETE',

                    success: function(response) {
                        if (response == 'success') {
                            $("#delete-success").trigger("click");

                            tabel.ajax.reload();
                            $('.loader').modal('hide');
                        } else {
                            $("#delete-wrong").trigger("click");

                        }

                    }
                })
            }

        }

        function updatej(id) {
            console.log(id)
            $("#con-close-modalu").modal('show');
            $("#jabatanu").val(id.jabatan);
            $("#idu").val(id.id);

        }
        $(document).ready(function(e) {

            tabel = $("#products-datatable2").DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('jabatan_p.index') }}",
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'

                    }, {
                        name: 'jabatan',
                        data: 'jabatan'
                    },
                    {
                        name: 'total',
                        data: 'total'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi'
                    },

                ]
            });

        })
    </script>
@endpush
