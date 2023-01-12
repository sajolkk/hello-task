@extends('layouts.app')
@push('css')
@endpush
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h5 class="m-0">Employee List</h5>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Employee List</li>
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
            <table class="table table-hover table-striped table-bordered" id="employeeTable">
                <thead class="bg-primary">
                    <th>Company</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr row_id="{{ $employee->id }}" >
                            <td class="p-1">
                                <select name="company_id" class="form-control bg-transparent border-0 row_data company px-0" edit_type="click" disabled>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $employee->company_id == $company->id? 'selected':'' }} >{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-1">
                                <input type="text" name="first_name" value="{{ $employee->first_name }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1">
                                <input type="text" name="last_name" value="{{ $employee->last_name }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1">
                                <input type="text" name="email" value="{{ $employee->email }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-1">
                                <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control bg-transparent border-0 row_data" edit_type="click" readonly autocomplete="off" >
                            </td>
                            <td class="p-0" >
                                <span class="btn p-1 btn-sm btn-primary btn_edit mb-1" row_id="{{ $employee->id }}" title="Employee Edit"><i class="fa fa-edit"></i></span>
                                <span class="btn p-1 btn-sm btn-danger d-none btn_cancel mb-1" row_id="{{ $employee->id }}" title="Employee Update Cancel"><i class="fa fa-ban"></i></span>
                                <span class="btn p-1 btn-sm btn-primary d-none btn_update mb-1" row_id="{{ $employee->id }}" title="Employee Update"><i class="fa fa-check"></i></span>
                                <a href="{{ route('employee.show',$employee->id) }}" class="btn p-1 mb-1 btn-sm btn-primary px-1" title="Show Employee"><i class="fa fa-info"></i></a>
                                <form action="{{ route('employee.destroy',$employee->id) }}" method="post" class="d-inline-block" onsubmit="return setAction(this)">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger p-1 mb-1" title="Employee Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-block py-2">
            {!! $employees->links('custom_paginator') !!}
        </div>
    </div>
@endsection
@push('js')
<script type="module">
    $(document).ready( function () {
        $('#employeeTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel',
            ],
            paging: false,
            info: false,
        });        
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
        formData['_token'] = '{{ csrf_token() }}';
        console.log(formData); 
        // ajax function
        $.ajax({
            type: "POST",
            method: "PUT",
            url: "{{ URL::to('employee') }}/"+row_id,
            data: formData,
            success: function(data){ 
                console.log(data);
                //hide update and cacel buttons
                tbl_row.find('.btn_update').addClass('d-none');
                tbl_row.find('.btn_cancel').addClass('d-none');

                //hide edit button
                tbl_row.find('.btn_edit').removeClass('d-none'); 

                //make the whole row non editable
                tbl_row.find('input[type="text"]')
                .attr('readonly',true).addClass('bg-transparent border-0').removeClass('bg-warning');
                //set previous data and non editable
                tbl_row.find('.company')
                .attr('disabled',true).addClass('bg-transparent border-0').removeClass('bg-warning');
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
<script >
    function setAction(form) {
        let isConfirm = confirm("Are you sure? \n You want to delete the company.");
        if(isConfirm){
            return true;
        }
        return false;
    }

    
</script>
@endpush
