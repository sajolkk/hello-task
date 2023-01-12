@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">Employee Show</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Employee</li>
            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee List</a></li>
            <li class="breadcrumb-item active">Employee Show</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 card p-3">
            <div class="form-group">
                <label for="company_id">Company:</label>
                <input type="text"  class="form-control" value="{{ $employee->company->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" value="{{ $employee->first_name }}" id="first_name" readonly>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text"  class="form-control" value="{{ $employee->last_name }}" id="last_name" readonly>
            </div>
            <div class="form-group">
                <label for="email">Employee E-mail:</label>
                <input type="email" class="form-control" value="{{ $employee->email }}" id="email" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Employee Phone:</label>
                <input type="text" class="form-control" value="{{ $employee->phone }}" id="phone" readonly>
            </div> 
        </div>
    </div>
@endsection
