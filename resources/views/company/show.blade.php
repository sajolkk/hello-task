@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">Company Show</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item ">Company</li>
            <li class="breadcrumb-item "><a href="{{ route('company.index') }}">Company List</a></li>
            <li class="breadcrumb-item active">Company Show</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 card p-3">
            <div class="form-group">
                <label for="name">Company Name:</label>
                <input type="text" class="form-control" value="{{ $company->name }}" id="name" readonly>
            </div>
            <div class="form-group">
                <label for="email">Company E-mail:</label>
                <input type="email" name="email" class="form-control" value="{{ $company->email }}" id="email" readonly>
            </div>            
            <div class="form-group">
                <label for="website">Company Website:</label>
                <input type="text" name="website" class="form-control" value="{{ $company->website }}" id="website" readonly>
            </div>
            <div class="form-group">
                <label for="logo" class="d-block">Company Logo:</label>
                <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }}" class="border border-primary rounded" width="200" height="200">
            </div>
        </div>
    </div>
@endsection
