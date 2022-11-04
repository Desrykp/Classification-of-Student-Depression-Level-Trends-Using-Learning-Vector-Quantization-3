@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Transformasi Gejala</h1> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Normalisasi</li>
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
                            <div class="card-title">Normalisasi</div>
                            <a href="/normalisasi/destroy" class="btn btn-danger btn-sm float-right " style="margin-left: 10px" onclick="return confirm('Are you sure?')" >Hapus Data</a>
                            <a href="/bobotawal" class="btn btn-warning btn-sm float-right "   >Lihat Bobot Awal</a>
                            {{-- <a href="/transformasi/normalisasi" class="btn btn-warning btn-sm float-right mr-3 " >Normalisasi Data</a> --}}

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable1" class="table table-bordered table-hover display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)

                                    <tr>
                                        <td>{{ $item->no }}</td>
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
                                        <td>{{ $item->kelas }}</td>

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




@stop
