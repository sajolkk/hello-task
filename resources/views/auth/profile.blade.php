@extends('layouts.app')
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h1 class="m-0">Profile</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
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

                <div class="card-title ps-3 pt-3 pb-2" >
                    User Information
                    <i class="fa fa-edit btn btn-sm btn-primary float-end me-3 editBtn" title="Click for edit your profile" onclick="editf()" ></i>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="name">Name:</label>
                            <input class="form-control editAble" id="editAble" type="text" name="name" value="{{ $user->name }}" required readonly="true">
                            @if($errors->has('name'))
                                <span class="text-danger" >{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">E-mail:</label>
                            <input class="form-control editAble" type="text" name="email" value="{{ $user->email }}" required readonly="true">
                            @if($errors->has('email'))
                                <span class="text-danger" >{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-2 text-end d-none" id="btnSection">
                            <button type="button" class="btn btn-danger" onclick="cancelf()">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@push('js')
<script>
    // profile edit able function
    function editf(){
        $(".editAble").prop('readonly',false);
        $("#btnSection").removeClass('d-none');
        $('.editBtn').addClass('d-none');
    }

    // profile edit cancel function
    function cancelf(){
        $(".editAble").prop('readonly',true);
        $("#btnSection").addClass('d-none'); 
        $('.editBtn').removeClass('d-none');
    }
</script> 
@endpush
