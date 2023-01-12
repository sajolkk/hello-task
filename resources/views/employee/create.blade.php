@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">New Employee Create</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item">Employee</li>
            <li class="breadcrumb-item active">New Employee Create</li>
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
            <form action="{{ route('employee.store') }}" method="post" >
                @csrf
                <div class="form-group">
                    <label for="company_id">Company:</label>
                    <select name="company_id" class="form-select" id="company_id">
                        <option value="">Select employee</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id? 'selected':'' }} >{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('company_id'))
                        <span class="text-danger" >{{ $errors->first('company_id') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" id="first_name" placeholder="Write employee first name">
                    @if($errors->has('first_name'))
                        <span class="text-danger" >{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" id="last_name" placeholder="Write employee last name">
                    @if($errors->has('last_name'))
                        <span class="text-danger" >{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Employee E-mail:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Write Employee e-mail">
                    @if($errors->has('email'))
                        <span class="text-danger" >{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Employee Phone:</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" id="phone" placeholder="example: +8801861218721">
                    @if($errors->has('phone'))
                        <span class="text-danger" >{{ $errors->first('phone') }}</span>
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
