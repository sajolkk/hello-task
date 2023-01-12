@extends('layouts.app')
@push('css')
@endpush
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">Company List</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Company List</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row card">
        <div class="col-md-12 p-2 card-body">
            <table class="table table-hover table-striped table-bordered" id="companyTable">
                <thead class="bg-primary">
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Website</th>
                    <th>Logo</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr row_id="{{ $company->id }}" >
                            <td class="p-1">
                                <input type="text" name="name" value="{{ $company->name }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1">
                                <input type="text" name="email" value="{{ $company->email }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1">
                                <input type="text" name="website" value="{{ $company->website }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1 img_row" >
                                <input type="file" name="logo" class="form-control d-none row_data imageChange" edit_type="click">
                                <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }}" class="rounded row_data_img" width="30" height="30" >
                            </td>
                            <td class="p-0" >
                                <span class="btn p-1 btn-sm btn-primary btn_edit mb-1" row_id="{{ $company->id }}" title="Company Edit"><i class="fa fa-edit"></i></span>
                                <span class="btn p-1 btn-sm btn-danger d-none btn_cancel mb-1" row_id="{{ $company->id }}" title="Company Update Cancel"><i class="fa fa-ban"></i></span>
                                <span class="btn p-1 btn-sm btn-primary d-none btn_update mb-1" row_id="{{ $company->id }}" title="Company Update"><i class="fa fa-check"></i></span>
                                <a href="{{ route('company.show',$company->id) }}" class="btn p-1 mb-1 btn-sm btn-primary px-1" title="Show company"><i class="fa fa-info"></i></a>
                                <form action="{{ route('company.destroy',$company->id) }}" method="post" class="d-inline-block" onsubmit="return setAction(this)">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger p-1 mb-1" title="Company Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-block py-2">
            {!! $companies->links('custom_paginator') !!}
        </div>
    </div>
@endsection
@push('js')
<script type="module">
    var base64 = "";
    $(document).ready( function () {
        $('#companyTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel',
            ],
            paging: false,
            info: false,
        });        
    });
    $(document).on('change', '.imageChange', function(event){
        // var imgValue = 
        var ext = event.target.value.split('.').pop().toLowerCase().toLowerCase();    
        var arrayExtensions = ['jpeg','png','jpg'];
        if (arrayExtensions.lastIndexOf(ext) == -1) {
            alert("Invalid Logo \n The logo must be a file of type: jpeg, png, jpg.");
            $(this).val("");
        }else{
            var img = event.target.files[0];
            var reader = new FileReader();
            reader.onloadend = function()
            {
                base64 = reader.result;
            }
            reader.readAsDataURL(img);
        }        
    });

    //--->save whole row entery > start	
    $(document).on('click', '.btn_update', function(event) {
        event.preventDefault();
        var tbl_row = $(this).closest('tr');
        var row_id = tbl_row.attr('row_id');
        
        //--->get row data > start
        var formData = {}; 
        tbl_row.find('.row_data').each(function(index, val) 
        {   
            var inputName = $(this).attr('name');  
            var inputValue  =  $(this).val();
            formData[inputName] = inputValue;            
        });
        if(formData.logo){
            formData['logo'] = base64;
        }        
        formData['_token'] = '{{ csrf_token() }}';
        // ajax function
        $.ajax({
            type: "POST",
            method: "PUT",
            url: "{{ URL::to('company') }}/"+row_id,
            data: formData,
            success: function(data){ 
                let company = $.parseJSON(data);
                //hide update and cacel buttons
                tbl_row.find('.btn_update').addClass('d-none');
                tbl_row.find('.btn_cancel').addClass('d-none');

                //hide edit button
                tbl_row.find('.btn_edit').removeClass('d-none'); 
                tbl_row.find('input[type="text"]')
                .attr('readonly',true).addClass('bg-transparent').removeClass('bg-warning');
                tbl_row.find('.img_row').children('input[type="file"]').addClass('d-none').val("");
                tbl_row.find('.img_row').children('img').removeClass('d-none').attr('src','/storage/'+company.logo);
            },
            error: function(data){
                // Error...
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function(index, value) {
                    alert(value);
                });
            }
        });
    });
    //--->save whole row entery > end	
        
</script>
<script>
    function setAction(form) {
        let isConfirm = confirm("Are you sure? \n You want to delete the company. \n *Note: "
            +"If you delete the company, all employees of this company will be deleted automatically*");
        if(isConfirm){
            return true;
        }
        return false;
    }

    
</script>
@endpush
