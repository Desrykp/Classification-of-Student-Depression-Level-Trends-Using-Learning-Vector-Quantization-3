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
                        <li class="breadcrumb-item active">Pengujian</li>
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
                            <div class="card-title">Hasil Pengujian</div>
                            <a href="/pengujian/proses" class="btn btn-warning btn-sm float-right mr-3">Mulai Pengujian</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            Learning Rate &nbsp; : <b>{{ $learningrate }}</b> <br>
                            Window &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>{{ $window }}</b> <br>

                            <table id="datatable2" class="table table-bordered table-hover display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Data Ke</th>
                                        <th>Kelas Data Uji</th>
                                        <th>Kelas LVQ3</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key=>$item)
                                    @if($item->keterangan=='Salah')
                                    <tr  style="background-color: red;">

                                    @endif

                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->data_ke }}</td>
                                        <td>{{ $item->kelas_data_uji }}</td>
                                        <td>{{ $item->kelas_lvq3 }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Perhitungan Akurasi</div>
                            {{--  <a href="/pengujian/proses" class="btn btn-warning btn-sm float-right mr-3">Lakukan Pengujian</a>  --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered " style="width:100%">
                                {{--  <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Ringan</th>
                                        <th>Sedang</th>
                                        <th>Berat</th>
                                    </tr>
                                </thead>  --}}
                                <tbody>

                                    <tr>
                                        <td></td>
                                        <td colspan="4"><b><center>Kelas Hasil Uji</center> </b></td>

                                    </tr>
                                    <tr>
                                        <th rowspan="4" style="width: 10px;vertical-align: middle;writing-mode: vertical-lr"><center><b>Kelas Sebenarnya </b></center></th>
                                        <td><b>Kelas</b></td>
                                        <td><b>Ringan</b></td>
                                        <td><b>Sedang</b></td>
                                        <td><b>Berat</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Ringan</b></td>
                                        <td>{{ $ringansama }}</td>
                                        <td>{{ $ringansedang }}</td>
                                        <td>{{ $ringanberat }}</td>
                                    </tr>
                                    <tr>

                                        <td><b>Sedang</b></td>
                                        <td>{{ $sedangringan }}</td>
                                        <td>{{ $sedangsama }}</td>
                                        <td>{{ $sedangberat }}</td>
                                    </tr>
                                    <tr>

                                        <td><b>Berat</b></td>
                                        <td>{{ $beratringan }}</td>
                                        <td>{{ $beratsedang }}</td>
                                        <td>{{ $beratsama }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5>Akurasi : {{ $ringansama }}+{{ $sedangsama }}+{{ $beratsama }}</h5>
                            <div class="row">
                                <div class="col-4">
                                    <table class="table">
                                        <tr class=" border-bottom">
                                            <td>{{ $ringansama }}</td>
                                            <td>+</td>
                                            <td>{{ $sedangsama }}</td>
                                            <td>+</td>
                                            <td>{{ $beratsama }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><center>{{ $counth }}</center></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-8">
                                <h1>X 100  =  {{ $hasilpembagian }} %</h1>
                                </div>
                            </div>
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
