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
                        <h4 class="page-title">Penilaian Perilaku Kerja</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Penilaian Perilaku Kerja</a></li>

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
                                <table id="staf" class="table table-hover table-sm">
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
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Penilaian Perilaku Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <i class="mdi mdi-alert-circle-outline me-2"></i> <span id="jj"></span>
                        <div id="lvl"></div>
                    </div>
                    {!! $form !!}
                </div>

            </div>
        </div>
    </div><!-- /.modal -->
    <div class="modal fade" id="check" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.2);"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Preview Penilaian Kinerja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div id="posisinya" class="modal-body">



                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="integrasi" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.2);"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Preview Integrasi Hasil Penilaian Kinerja PNS
                        {{ Session::get('tahon') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div id="integrasimodal" class="modal-body">


                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="bp" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.2);"
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
    <button style="display: none;" id="toastr-three"></button><button style="display: none;"
        id="toastr-one"></button><button style="display: none;" id="delete-wrong"></button><button style="display: none;"
        id="delete-success"></button>
    <div id="kriteria" class="modal fade shadow-lg" tabindex="-1" role="dialog"
        style="background:
                                                                                                                                                                                                                                                                                                                                                                                                    rgba(0,0,0,0.2);"
        aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">ASPEK PERILAKU KERJA
                        ORIENTASI PELAYANAN</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table  table-sm table-bordered table-striped">
                        <thead>

                            <tr>
                                <th style="width: 10%;vertical-align: middle;" class="text-center" scope="col">Defenisi
                                </th>

                                <th colspan="2"
                                    style="width: 60%;vertical-align: middle;
                                                                                                                                                                    "
                                    scope="col">
                                    Sikap
                                    dan
                                    perilaku
                                    kerja pegawai dalam memberikan pelayanan terbaik kepada yang dilayani antara lain
                                    meliputi
                                    masyarakat, atasan, rekan kerja, unit kerja terkait, dan/atau instansi lain.

                                </th>


                            </tr>
                            <tr>
                                <th style="width: 10%" class="text-center" scope="col">Level Perilaku Kerja</th>

                                <th style="width: 55%;vertical-align: middle;
                                                                                                                                                                    "
                                    class="text-center" scope="col">
                                    Indikator
                                    Perilaku
                                    Kerja
                                </th>
                                <th style="width: 35%;vertical-align: middle;
                                                                                                                                                                    "
                                    class=" text-center" scope="col">
                                    Situasi
                                </th>

                            </tr>
                        </thead>
                        <tbody class="tdk">

                            <tr>
                                <th class="text-center" scope="row">1</th>

                                <th scope="row">Memahami dan memberikan pelayanan yang baik sesuai standar.
                                </th>
                                <td rowspan="7">
                                    a. Ketika memberikan pelayanan kepada
                                    pihak-pihak yang dilayani.
                                    <br>
                                    b. Ketika membangun hubungan dengan pihak-pihak yang dilayani.
                                    <br>
                                    c. Ketika diharapkan memberikan nilai- nilai tumbuh atas layanan yang diberikan kepada
                                    pihak-pihak yang dilayani. <br>
                                    d. Ketika beradaptasi dengan menggunakan teknologi digital. <br>
                                    e. Ketika diharapkan dengan benturan kepentingan.

                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">2</th>
                                <th scope="row">Memberikan pelayanan sesuai standar dan menunjukkan komitmen dalam
                                    pelayanan.
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">3</th>
                                <th scope="row">Memberikan pelayanan diatas standar untuk memastikan keputusan
                                    pihak-pihak yang dilayani sesuai arahan atasan.

                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">4</th>
                                <th scope="row">Memberikan pelayanan diatas standar dan membangun nilai tambah
                                    dalam pelayanan.


                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">5</th>
                                <th scope="row">Berusaha memenuhi kebutuhan mendasar dalam pelayanan dan
                                    percepatan penanganan masalah.


                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">6</th>
                                <th scope="row">Mengevaluasi dan mengantisipasi kebutuhan pihak-pihak yang dilayani.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">7</th>
                                <th scope="row">Mengembangkan sistem pelayanan baru bersifat jangka panjang untuk
                                    memastikan kebutuhan dan kepuasan pihak-pihak yang dilayani.




                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="kkomitmen" class="modal fade shadow-lg" tabindex="-1" role="dialog"
        style="background:
                                                                                                                                                                                                                                                                                                                                                                                                rgba(0,0,0,0.2);"
        aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">ASPEK PERILAKU KERJA KOMITMEN
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table  table-sm table-bordered table-striped">
                        <thead>

                            <tr>
                                <th style="width: 10%;vertical-align: middle;" class="text-center" scope="col">Defenisi
                                </th>

                                <th colspan="2"
                                    style="width: 60%;vertical-align: middle;
                                                                                                                                                                "
                                    scope="col">
                                    Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan pegawai untuk mewujudkan
                                    tujuan organisasi dengan
                                    mengutamakan kepentingan dinas daripada kepentingan diri sendiri, seseorang, dan/atau
                                    golongan.


                                </th>


                            </tr>
                            <tr>
                                <th style="width: 10%" class="text-center" scope="col">Level Perilaku Kerja</th>

                                <th style="width: 55%;vertical-align: middle;
                                                                                                                                                                "
                                    class="text-center" scope="col">
                                    Indikator
                                    Perilaku
                                    Kerja
                                </th>
                                <th style="width: 35%;vertical-align: middle;
                                                                                                                                                                "
                                    class=" text-center" scope="col">
                                    Situasi
                                </th>

                            </tr>
                        </thead>
                        <tbody class="tdk">

                            <tr>
                                <th class="text-center" scope="row">1</th>

                                <th scope="row">Memahami dan mengetahui perilaku dasar menyangkut komitmen organisasi.

                                </th>
                                <td rowspan="7">
                                    a. Ketika menjalankan tugas serta
                                    kewajibannya sebagai anggota organisasi.
                                    <br>
                                    b. Ketika harus menjaga citra organisasi.
                                    <br>
                                    c. Ketika menghadapi keadaan dilematis. <br>
                                    d. Ketika diharapkan memupuk jiwa nasionalisme. <br>
                                    e. Ketika dihadapkan dengan masalah korupsi/ kolusi/ nepotisme (KKN).

                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">2</th>
                                <th scope="row">Menunjukkan perilaku atau tindakan sesuai dengan aturan atau nilai-nilai
                                    organisasi sebatas mengikuti arahan atasan.

                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">3</th>
                                <th scope="row">Menunjukkan tindakan dan perilaku yang konsisten serta meneladani perilaku
                                    komitmen terhadap organisasi.


                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">4</th>
                                <th scope="row">Mendukung tujuan serta menjaga citra organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">5</th>
                                <th scope="row">Bertindak berdasarkan nilai-nilai organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">6</th>
                                <th scope="row">Menunjukkan komitmen atas kepentingan yang lebih besar daripada
                                    kepentingan pribadi.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">7</th>
                                <th scope="row">Mengambil keputusan atau tindakan yang membutuhkan pengorbanan yang
                                    besar (menjadi model perilaku positif yang terintegrasi)




                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="kkerjasama" class="modal fade shadow-lg" tabindex="-1" role="dialog"
        style="background:
                                                                                                                                                                                                                                                                                                                                                                                                rgba(0,0,0,0.2);"
        aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">ASPEK PERILAKU KERJA KOMITMEN
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table  table-sm table-bordered table-striped">
                        <thead>

                            <tr>
                                <th style="width: 10%;vertical-align: middle;" class="text-center" scope="col">Defenisi
                                </th>

                                <th colspan="2"
                                    style="width: 60%;vertical-align: middle;
                                                                                                                                                                "
                                    scope="col">
                                    Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan pegawai untuk mewujudkan
                                    tujuan organisasi dengan
                                    mengutamakan kepentingan dinas daripada kepentingan diri sendiri, seseorang, dan/atau
                                    golongan.


                                </th>


                            </tr>
                            <tr>
                                <th style="width: 10%" class="text-center" scope="col">Level Perilaku Kerja</th>

                                <th style="width: 55%;vertical-align: middle;
                                                                                                                                                                "
                                    class="text-center" scope="col">
                                    Indikator
                                    Perilaku
                                    Kerja
                                </th>
                                <th style="width: 35%;vertical-align: middle;
                                                                                                                                                                "
                                    class=" text-center" scope="col">
                                    Situasi
                                </th>

                            </tr>
                        </thead>
                        <tbody class="tdk">

                            <tr>
                                <th class="text-center" scope="row">1</th>

                                <th scope="row">Memahami dan mengetahui perilaku dasar menyangkut komitmen organisasi.

                                </th>
                                <td rowspan="7">
                                    a. Ketika menjalankan tugas serta
                                    kewajibannya sebagai anggota organisasi.
                                    <br>
                                    b. Ketika harus menjaga citra organisasi.
                                    <br>
                                    c. Ketika menghadapi keadaan dilematis. <br>
                                    d. Ketika diharapkan memupuk jiwa nasionalisme. <br>
                                    e. Ketika dihadapkan dengan masalah korupsi/ kolusi/ nepotisme (KKN).

                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">2</th>
                                <th scope="row">Menunjukkan perilaku atau tindakan sesuai dengan aturan atau nilai-nilai
                                    organisasi sebatas mengikuti arahan atasan.

                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">3</th>
                                <th scope="row">Menunjukkan tindakan dan perilaku yang konsisten serta meneladani perilaku
                                    komitmen terhadap organisasi.


                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">4</th>
                                <th scope="row">Mendukung tujuan serta menjaga citra organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">5</th>
                                <th scope="row">Bertindak berdasarkan nilai-nilai organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">6</th>
                                <th scope="row">Menunjukkan komitmen atas kepentingan yang lebih besar daripada
                                    kepentingan pribadi.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">7</th>
                                <th scope="row">Mengambil keputusan atau tindakan yang membutuhkan pengorbanan yang
                                    besar (menjadi model perilaku positif yang terintegrasi)




                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="kinisiatif" class="modal fade shadow-lg" tabindex="-1" role="dialog"
        style="background:
                                                                                                                                                                                                                                                                                                                                                                                                rgba(0,0,0,0.2);"
        aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">ASPEK PERILAKU KERJA KOMITMEN
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table  table-sm table-bordered table-striped">
                        <thead>

                            <tr>
                                <th style="width: 10%;vertical-align: middle;" class="text-center" scope="col">Defenisi
                                </th>

                                <th colspan="2"
                                    style="width: 60%;vertical-align: middle;
                                                                                                                                                                "
                                    scope="col">
                                    Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan pegawai untuk mewujudkan
                                    tujuan organisasi dengan
                                    mengutamakan kepentingan dinas daripada kepentingan diri sendiri, seseorang, dan/atau
                                    golongan.


                                </th>


                            </tr>
                            <tr>
                                <th style="width: 10%" class="text-center" scope="col">Level Perilaku Kerja</th>

                                <th style="width: 55%;vertical-align: middle;
                                                                                                                                                                "
                                    class="text-center" scope="col">
                                    Indikator
                                    Perilaku
                                    Kerja
                                </th>
                                <th style="width: 35%;vertical-align: middle;
                                                                                                                                                                "
                                    class=" text-center" scope="col">
                                    Situasi
                                </th>

                            </tr>
                        </thead>
                        <tbody class="tdk">

                            <tr>
                                <th class="text-center" scope="row">1</th>

                                <th scope="row">Memahami dan mengetahui perilaku dasar menyangkut komitmen organisasi.

                                </th>
                                <td rowspan="7">
                                    a. Ketika menjalankan tugas serta
                                    kewajibannya sebagai anggota organisasi.
                                    <br>
                                    b. Ketika harus menjaga citra organisasi.
                                    <br>
                                    c. Ketika menghadapi keadaan dilematis. <br>
                                    d. Ketika diharapkan memupuk jiwa nasionalisme. <br>
                                    e. Ketika dihadapkan dengan masalah korupsi/ kolusi/ nepotisme (KKN).

                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">2</th>
                                <th scope="row">Menunjukkan perilaku atau tindakan sesuai dengan aturan atau nilai-nilai
                                    organisasi sebatas mengikuti arahan atasan.

                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">3</th>
                                <th scope="row">Menunjukkan tindakan dan perilaku yang konsisten serta meneladani perilaku
                                    komitmen terhadap organisasi.


                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">4</th>
                                <th scope="row">Mendukung tujuan serta menjaga citra organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">5</th>
                                <th scope="row">Bertindak berdasarkan nilai-nilai organisasi secara konsisten.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">6</th>
                                <th scope="row">Menunjukkan komitmen atas kepentingan yang lebih besar daripada
                                    kepentingan pribadi.



                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">7</th>
                                <th scope="row">Mengambil keputusan atau tindakan yang membutuhkan pengorbanan yang
                                    besar (menjadi model perilaku positif yang terintegrasi)




                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tabel2;
        let url = window.location.origin;

        function integrasi(id) {
            console.log(id);
            $.ajax({
                url: "{{ route('perilaku.integrasi') }}",
                type: 'get',
                data: {
                    id: id,
                },
                success: function(e) {
                    $("#toastr-three").trigger("click");
                    tabel2.ajax.reload();
                    $("#integrasimodal").html(e);
                    console.log(e);

                }
            });
        }

        function integr(id) {
            console.log(id);
            data = confirm('Integrasi Nilai');
            if (data) {
                $.ajax({
                    url: "{{ route('perilaku.integrasinilai') }}",
                    type: 'post',
                    data: {
                        id: id,
                    },
                    success: function(e) {
                        $("#toastr-three").trigger("click");
                        tabel2.ajax.reload();
                        console.log(e);

                    }
                });
            }
        }

        function reset(id) {
            data = confirm('apakah anda yakin?');
            if (data) {
                $.ajax({
                    url: "{{ route('perilaku.reset') }}",
                    type: 'post',
                    data: {
                        id: id,
                    },
                    success: function(e) {
                        $("#toastr-three").trigger("click");
                        tabel2.ajax.reload();

                    }
                });
            }

        }

        function savenilai(np, id, nilai) {
            $.ajax({
                url: "{{ route('perilaku.savenilaip') }}",
                type: 'post',
                data: {
                    id: id,
                    np: np,
                    nilai:nilai
                },
                success: function(e) {

                    $("#toastr-three").trigger("click");

                }
            });
        }

        function check(id, nilai, idj, np, idm) {
            console.log(np);
            $.ajax({
                url: "{{ route('perilaku.check') }}",
                type: 'post',
                data: {
                    data: id,
                    nilai: nilai,
                    jenjang: idj,
                    np: np,
                    idm: idm

                },
                success: function(e) {
                    $("#posisinya").html(e);
                    $("#toastr-three").trigger("click");
                    tabel2.ajax.reload();

                }
            });

        }

        function nilai(id, idd, ix) {
            console.log(ix)
            console.log(id);
            html = "Jenjang jabatan pegawai " + ix.jabatan.jabatan + ' - ' +
                ix.jenjang;
            htmll = "Level yang dipersyaratkan sesuai jenjang " + ix.level_min + " - " + ix.level_max;
            $("#jj").html(html);
            $("#lvl").html(htmll);

            $("#orientasi").val(id['orientasi_pelayanan']);
            $("#komitmen").val(id['komitmen']);
            $("#inisiatif").val(id['inisiatif_kerja']);
            $("#kerja").val(id['kerjasama']);
            $("#kepemimpinan").val(id['kepemimpinan']);
            $("#integritas").val(id['integritas']);
            $("#disiplin").val(id['disiplin']);
            tabel2.ajax.reload();
            $("#idp").val(id['id']);
        }


        function setuju(id, ids) {
            console.log(id);
            let check = confirm('Klik Ya Untuk Melanjutkan');
            console.log(id);
            if (check) {
                $.ajax({
                    url: "{{ route('adendum.setuju') }}",
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




        $(document).ready(function() {
            $("#btnsms1").on('click', function(e) {
                $("#sms1").trigger('submit');
            })
            $("#sms1").on('submit', function(e) {
                e.preventDefault();
                var datapen = $(this).serialize();
                console.log(datapen);

                $.ajax({
                    url: "{{ route('perilaku.sms1') }}",
                    type: 'post',
                    data: datapen,
                    success: function(e) {
                        console.log(e);
                        if (e == 'success') {
                            $("#toastr-three").trigger("click");
                            tabel2.ajax.reload();
                        }
                    }
                });


            })

        });


        tabel2 = $("#staf").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('perilaku-kerja.index') }}"
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
