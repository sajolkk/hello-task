@extends('layouts.app')
@push('css')
@endpush
@section('breadcrumb')
    <div class="row mb-2">            
        <div class="col-sm-6">
            <h1 class="m-0">Company</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Company</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 p-2 bg-white">
            <table class="table table-hover table-striped" id="companyTable">
                <thead class="bg-primary">
                    <th>SL</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Website</th>
                    <th>Logo</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($companies as $key => $company)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->website }}</td>
                            <td>{{ $company->logo }}</td>
                            <td>
                                <span>Edit</span>
                                <span>Delete</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
<script type="module">
    $(document).ready( function () {
        $('#companyTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel',
            ]
        });
    });
</script>
@endpush
