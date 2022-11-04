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
                        <li class="breadcrumb-item active">Pelatihan</li>
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
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Peramater Pembelajaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('post.pelatihan') }}" >
                            @csrf
                          <div class="card-body">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Learning Rate (a)</label>
                              <div class="col-sm-8">
                                <select class="form-control" name="learningRate" required>
                                    <option value="">-pilih-</option>
                                    <option value="0.1">0.1</option>
                                    <option value="0.2">0.2</option>
                                    <option value="0.3">0.3</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputPassword3" class="col-sm-4 col-form-label">Minimum Learning Rate (min a)</label>
                              <div class="col-sm-8">
                                <input type="text" name="mina" class="form-control" id="inputPassword3" required>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Window</label>
                                <div class="col-sm-8">
                                  <select class="form-control" name="window" required>
                                      <option value="">-pilih-</option>
                                      <option value="0.2">0.2</option>
                                      <option value="0.3">0.3</option>
                                      <option value="0.4">0.4</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Epsilon</label>
                                <div class="col-sm-8">
                                  <select class="form-control" name="epsilon" id="epsilon" required>
                                      <option value="">-pilih-</option>
                                      <option value="0.2">0.2</option>
                                      <option value="0.3">0.3</option>
                                      <option value="0.4">0.4</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="epsilon" class="col-sm-4 col-form-label">Epsilon (E)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="epsilon" id="epsilon" required>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Data Latih : Data Uji</label>
                              <div class="col-sm-8">
                                  <select class="form-control" name="pembagiandata" id="dLatih" required>
                                    <option value="">-pilih-</option>

                                    <option value="p91">90:10</option>
                                    <option value="p82">80:20</option>
                                    <option value="p73">70:30</option>
                                  </select>
                              </div>
                            </div>



                          </div>
                          <!-- /.card-body -->
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                          <!-- /.card-footer -->
                        </form>
                      </div>
                </div>



            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




@stop
