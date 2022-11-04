@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Gejala Awal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Gejala Awal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/datagejala/destroy" class="btn btn-danger btn-sm float-right" onclick="return confirm('Are you sure?')" >Hapus Semua</a>
                            <a href="/datagejala/transformasi" class="btn btn-warning btn-sm float-right mr-3">Transformasikan</a>
                            <a href="#" class="btn btn-primary btn-sm float-right mr-3" data-toggle="modal"
                                data-target="#modalTambah">Tambah Data</a>
                            <a href="#" class="btn btn-success btn-sm float-right mr-3" data-toggle="modal"
                                data-target="#modalImport">Import Data</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Semester</th>
                                        <th>X1</th>
                                        <th>X2</th>
                                        <th>X3</th>
                                        <th>X4</th>
                                        <th>X5</th>
                                        <th>X6</th>
                                        <th>X7</th>
                                        <th>X8</th>
                                        <th>X9</th>
                                        <th>Total</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key=>$item)

                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jk }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td>{{ $item->x1 }}</td>
                                        <td>{{ $item->x2 }}</td>
                                        <td>{{ $item->x3 }}</td>
                                        <td>{{ $item->x4 }}</td>
                                        <td>{{ $item->x5 }}</td>
                                        <td>{{ $item->x6 }}</td>
                                        <td>{{ $item->x7 }}</td>
                                        <td>{{ $item->x8 }}</td>
                                        <td>{{ $item->x9 }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td><a href="/datagejala/{{ $item->id }}/delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Hapus</a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="modalTambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('post.datagejalaawal') }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nama" class="form-control" id="inputEmail3" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select" name="jk" required>
                                        <option value=""></option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Semester</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" name="semester" class="form-control" id="inputEmail3" placeholder="Semester" required>
                                    </div>
                                </div>
                                <p>------------------------------------------------------------------------------------------------------------------</p>
                                    <p><b>Selama 2 minggu ini, seberapa sering anda terganggu oleh masalah-masalah yang dilampirkan pada 9 pertanyaan berikut ?</b></p>
                                    <p>Adapun keterangan pilihan adalah sebagai berikut :</p>
                                    <p>0 = Tidak sama sekali (0 hari)</p>
                                    <p>1 = Beberapa hari (1-7 hari)</p>
                                    <p>2 = Lebih dari setengah dari hari (7-13 hari)</p>
                                    <p>3 = Hampir setiap hari (14 hari)</p>
                                    <p>-----------------------------------------------------------------------------------------------------------------</p>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Sedikit minat atau kesenangan dalam melakukan sesuatu </label>
                                    <div class="col-sm-6">
                                        <input type="number"  min="0" max="3" name="x1" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Merasa sedih, tertekan, atau putus asa </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x2" class="form-control" id="inputEmail3"  required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kesulitan tidur, atau tidur terlalu banyak </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x3" class="form-control" id="inputEmail3"  required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Merasa lelah atau memiliki sedikit energi </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x4" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Nafsu makan yang buruk atau makan berlebihan </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x5" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Merasa buruk tentang diri sendiri _ atau bahwa anda gagal atau mengecewakan diri sendiri atau keluarga anda </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x6" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kesulitan Berkonsentrasi </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x7" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Bergerak atau berbicara sangat lambat sehingga orang lain bisa memperhatikan atau sebaliknya, menjadi sangat gelisah sehingga anda lebih banyak bergerak dari pada biasanya ?</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x8" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Memiliki pikiran bahwa anda lebih baik mati atau menyakiti diri sendiri</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="0" max="3" name="x9" class="form-control" id="inputEmail3" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



{{-- modal imnport --}}
<div class="modal fade" id="modalImport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- route ini dikirim ke web.php di name datagejala.import --}}
            <form class="form-horizontal" method="POST" action="{{ route('datagejala.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">File</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="fileImport" id="customFile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



@stop
