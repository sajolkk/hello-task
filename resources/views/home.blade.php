@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <h4>Welcome to hello task :)</h4>
            </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
