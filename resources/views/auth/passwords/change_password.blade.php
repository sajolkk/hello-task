@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h1 class="m-0">Password Change</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Password Change</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-danger">
                        {{ session('fail') }}
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="current_password" class="mb-0">Current Password:</label>
                            <input class="form-control" type="password" name="current_password" required >
                            @if($errors->has('current_password'))
                                <span class="text-danger" >{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="new_password" class="mb-0">New Password:</label>
                            <input class="form-control" type="password" name="new_password" value="" required >
                            @if($errors->has('new_password'))
                                <span class="text-danger" >{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="password_confirmation" class="mb-0">Confirmation Password:</label>
                            <input class="form-control" type="password" name="password_confirmation" value="" required >
                            @if($errors->has('password_confirmation'))
                                <span class="text-danger" >{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2 text-end " >
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection

