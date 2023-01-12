@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">New Company Create</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item ">Company</li>
            <li class="breadcrumb-item active">New Company Create</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 card p-3">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('fail'))
                <div class="alert alert-danger">
                    {{ session()->get('fail') }}
                </div>
            @endif
            <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Company Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Write company name">
                    @if($errors->has('name'))
                        <span class="text-danger" >{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Company E-mail:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Write company e-mail">
                    @if($errors->has('email'))
                        <span class="text-danger" >{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="website">Company Website:</label>
                    <input type="text" name="website" class="form-control" value="{{ old('website') }}" id="website" placeholder="www.hellotask.app">
                    @if($errors->has('website'))
                        <span class="text-danger" >{{ $errors->first('website') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="logo">Company Logo:</label>
                    <input type="file" name="logo" class="form-control" id="logo" value="{{ old('logo') }}">
                    @if($errors->has('logo'))
                        <span class="text-danger" >{{ $errors->first('logo') }}</span>
                    @endif
                </div>
                
                <div class="form-group mt-2 text-end">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
