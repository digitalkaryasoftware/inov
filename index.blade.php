@extends('trainer.layouts.app')

@section('main')
    <div x-data="data" class="container-fluid">
        <section>
            <div class="row gy-4">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-4">
                                <div class="flex-fill">
                                    <h2>{{ $data->Courses_name }}</h2>
                                    <p class="mb-0">Atur Trainer Untuk Kelas.</p>
                                </div>
                                <!-- Breadcrumb -->
                                <nav class="d-flex">
                                    <h6 class="mb-0">
                                        <a href="{{ route('trainer.dashboard.index') }}" class="text-secondary">Beranda</a>
                                        <span>/</span>
                                        <a href="{{ route('trainer.kelas.index') }}" class="text-secondary">Kelas</a>
                                        <span>/</span>
                                        <a href="" class="text-reset">Add Modul</a>
                                    </h6>
                                </nav>
                                <!-- Breadcrumb -->
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('trainer.modul.store') }}" method="POST" class="institusi-form">
                        @csrf
                        {{-- <input type="hidden" name="internship_project_id" value="{{ $data->id }}"> --}}
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Detail Kelas</h4>
                                <div class="mb-3">
                                    <table>
                                        <tr>
                                            <td>Nama Kelas</td>
                                            <td width="50px" align="right">:</td>
                                            <td>&nbsp;{{ $data->Courses_name }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <label for="entry-year" class="form-label">
                                    Tambah Modul
                                </label>
                                <input type="hidden" name="course_id" value="{{ $data->id }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-lg-4">

                                        <input type="text" class="form-control" name="modul" id="" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary">
                                            Tambah 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mt-3">
                        <div class="card-header">
                            {{-- <button x-on:click="addElement()" class="btn btn-primary" type="button">
                                        <i class="fas fa-plus me-2"></i>
                                        <span>Tambah Komponen</span>
                                    </button> --}}
                        </div>
                        <div class="card-body">
                            <div class="p-4 border rounded mb-4">
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <div class="h5">
                                            Modul
                                        </div>
                                    </div>
                                </div>
                                @forelse ($modul as $item)
                                    {{-- @dd($item) --}}
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <div class="">
                                                {{ $item->tittle }}
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button href="#" class="btn btn-primary btn-sm modalmodul" id=""
                                                data-id="{{ $item->id }}">
                                                <i class="fa fa-book"></i>
                                            </button>
                                            <a href="{{ route('trainer.modul.destroymodul', $item->id) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="p-4 text-center">
                                                <h6>Belum ada modul</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>



    <!-- Modal Sub Modul-->
    <div class="modal fade" id="modalmodul" style="backdrop-filter: blur(0px);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class="mt-3"><i class="bi bi-table"></i></i> Tabel Sub Modul
                    </h6>
                    <div class="mt-3 card">
                        <div class="card-body">
                            <input type="hidden" name="" id="id_modul">
                            <button type="button" class="btn btn-info mb-4 " data-mdb-dismiss="modal"
                                id="tambahsubmodul"><i class="bi bi-plus-lg"></i> Tambah</button>
                            <div class="table-responsive">
                                <table id="tablesubmodul" class="table table-striped nowrap text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th class="w-25">No</th>
                                            <th class="w-50">Nama Sub Modul</th>
                                            <th class="w-50">Deskripsi</th>
                                            <th class="w-25">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodytablemodul">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Mitra Kerjasama-->
    <div class="modal fade modal-md" id="modalTambahSubModul">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" id="storetablesubmodul" action="javascript:void(0)">
                    
                    <div class="modal-body">
                        <input type="hidden" name="modul_id" id="id_modul_tambah">
                        <h6 class="mt-3"><i class="bi bi-mortarboard-fill"></i> Title</h6>
                        <input name="title" type="text" class="form-control" style="" required>
                        <h6 class="mt-3"><i class="bi bi-mortarboard-fill"></i> Deskripsi</h6>
                        <textarea name="description" id="desk" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal"
                            onclick="showsubmodul()">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Mitra Kerjasama-->
    <div class="modal fade modal-md" id="modalDetailsubmodul">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" id="editsubmoduldetail" action="javascript:void(0)">
                    <div class="modal-body">
                        <input type="hidden" name="modul_id" id="id_modul_detail">
                        <h6 class="mt-3"><i class="bi bi-mortarboard-fill"></i> Title</h6>
                        <input name="title" type="text" class="form-control" id="titleedit" style=""
                            required>
                        <h6 class="mt-3"><i class="bi bi-mortarboard-fill"></i> Deskripsi</h6>
                        <textarea name="desk" id="desk" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal"
                            onclick="showsubmodulffromdetail()">Kembali</button>
                        <button type="submit" class="btn btn-primary"><i
                                class="mx-1 bi bi-pencil-fill"></i>Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('script')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
        });

        function showsubmodulffromdetail() {
            $('#modalDetailsubmodul').modal('hide');
            $('#modalmodul').modal('show');

        }

        function showsubmodul() {
            $('#modalTambahSubModul').modal('hide');
            $('#modalmodul').modal('show');
            var dt = $('#tablesubmodul').DataTable();
        }

        $('#tambahsubmodul').click(function() {
            var modul_id = $('#id_modul').val();
            // alert(modul_id);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('trainer/checkid-add-submodul/') }}/" + modul_id,
                success: function(e) {
                    var datacontentbody = [];
                    var no = 1;
                    console.log(e);
                    $('#modalmodul').modal('hide');
                    $('#modalTambahSubModul').modal('show');
                    $('#id_modul_tambah').val(e.id_modul);
                },
                error: function(err) {
                    console.log(err)
                }
            });
        });

        $('#storetablesubmodul').submit(function(e) {
            var formData = new FormData(this);
            console.log(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('trainer/store-submodul') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(e) {
                    Swal.fire(
                        'Berhasil!',
                        'Content Data sudah di tambahkan.',
                        'success'
                    );

                    document.getElementById("storetablesubmodul").reset();
                    $('#modalTambahSubModul').modal('hide');
                    showContent();
                    $('#modalmodul').modal('show');
                },
                error: function(data) {
                    Swal.fire(
                        'Oops...',
                        'Terjadi kesalahan saat Content Data sudah di tambahkan.',
                        'error'
                    );
                    console.log(data);
                }
            });

        });


        $('.modalmodul').click(function() {
            var modul_id = $(this).attr("data-id");
            // alert(modul_id);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('trainer/get-sub-modul-list/') }}/" + modul_id,
                success: function(e) {
                    var datacontentbody = [];
                    var no = 1;
                    console.log(e);
                    e.data.forEach(function(val) {
                        datacontentbody += [`
                                        <tr>
                                            <td>${no}</td>
                                            <td>${val.title}</td>
                                            <td>${val.description}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-mdb-dismiss="modal" onclick="showdetailsubmodul(${val.id })"><i class="bi bi-pencil-fill"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-mdb-dismiss="modal" onclick="deletesubmodul(${val.id})"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                        `];
                        no++;
                    })
                    $('#id_modul').val(e.id_moduls);
                    $('#modalmodul').modal('show');
                    $('#bodytablemodul').html(datacontentbody);
                    $('#tablesubmodul').DataTable();

                },
                error: function(err) {
                    console.log(err)
                }
            });
        });


        function showdetailsubmodul(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ url('trainer/getdetailsubmodul-byid') }}/" + id,
                success: function(e) {
                    console.log(e);
                    $('#id_modul_detail').val(e.id);
                    $('#titleedit').val(e.title);
                    $('#videourl_edit').val(e.description);
                    $('#modalmodul').modal('hide');
                    $('#modalDetailsubmodul').modal('show');
                },
                error: function(err) {

                }
            });
        }

        $('#editsubmoduldetail').submit(function(e) {
            var formData = new FormData(this);
            var value = document.getElementById('id_modul_detail').value;
            console.log(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('trainer/editdetailsubmodul') }}/" + value,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(e) {
                    Swal.fire(
                        'Berhasil!',
                        'Content Data sudah di tambahkan.',
                        'success'
                    );
                    // document.getElementById("storetableMitra").reset();
                    $('#modalDetailMitra').modal('hide');
                    showContent();
                    $('#modalmodul').modal('show');
                },
                error: function(data) {
                    Swal.fire(
                        'Oops...',
                        'Terjadi kesalahan saat Content Data sudah di tambahkan.',
                        'error'
                    );
                    console.log(data);
                }
            });

        });

        function deletesubmodul(id) {
            Swal.fire({
                icon: 'question',
                html: '<p>Hapus?</p><p class="text-danger">Data Tidak Bisa di kembalikan!</p>',
                showCancelButton: true,
            }).then((result) => {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('trainer/delete-submodul') }}/" + id,
                    cache: false,
                    success: function(e) {
                        Swal.fire(
                            'Berhasil!',
                            'Content Data sudah di Hapus.',
                            'success'
                        );
                        setTimeout(
                            "location.reload()",
                            1000);
                    },
                    error: function(data) {

                    }
                })
            });
            // $.ajax({
            //     type:  'POST'
            // })
        }
    </script>

<script>
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var img = document.getElementById("thumbnil");
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function(aImg) {
                    return function(e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
        ClassicEditor
            .create(document.querySelector('#desk'))
            .then(newEditor => {
                editorPortofolio = newEditor;
            })
            .catch(error => {
                // console.error(error);
            });
    </script>



@endpush
