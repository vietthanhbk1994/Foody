@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Users</h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('users.create') }}">Add New</a>
    </h1>
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>IsAdmin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="is_admin">IsAdmin</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@endsection

@push('end-scripts')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#users-table').DataTable({
    "dom": 'lrtip',
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('user.get') }}',
        method: 'GET',
        data: function (d) {
            d.is_admin = $('select[name=is_admin]').val();
        }
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'username', name: 'username'},
        {data: 'email', name: 'email'},
        {data: 'is_admin', name: 'is_admin'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    initComplete: function () {
        this.api().columns().every(function () {
            var column = this;
            var input = document.createElement("input");
            $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val()).draw();
                    });
            $('<select name="is_admin"><option value=""></option><option value="1">Admin</option><option value="2">User</option></select>')
                    .appendTo($('.is_admin').empty())
                    .on('change', function () {
                        column.draw();
                    });

        });
        $("tfoot tr th:last-child").text("");
    }
});
</script>
@endpush

