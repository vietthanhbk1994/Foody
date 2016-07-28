@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Categories</h1>
    @can('admin')
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('categories.create') !!}">Add New</a>
    </h1>
    @endcan
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered" id="categories-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
    $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('category.get') }}',
            method: 'GET'
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
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
            });
            $("tfoot tr th:last-child").text("");
        }
    });
    
    $("body").on("submit", "form[name='delete']", function (e) {
        var form = this;
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirmed) {
            if (isConfirmed) {
                swal({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonText: "Undo!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    form.submit();
                });
            } else {
                swal("Cancelled", "Your file is safe :)", "error");
            }
        });
    });
</script>
@endpush

