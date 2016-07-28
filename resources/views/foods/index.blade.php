@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1 class="pull-left">Foods</h1>
    @can('admin')
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('foods.create') !!}">Add New</a>
    </h1>
    @endcan
</section>
<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body">
            <table class="table table-bordered" id="foods-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category Id</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="category_id">Category Id</th>
                        <th class="author">Author</th>
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
    $('#foods-table').DataTable({
        "dom": 'lrtip',
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('food.get') }}',
            method: 'GET',
            data: function (d) {
                d.category_id = $('select[name=category_id]').val();
                d.author = $('input[name=author]').val();
            }
        },
        columns: [
            {data: 'id', name: 'foods.id'},
            {data: 'name', name: 'foods.name'},
            {data: 'category_id', name: 'category_id'},
            {data: 'author', name: 'author'},
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
                $('{{ Form::select('category_id', $category_ids, null, ['placeholder' => '', 'class' => 'form-control search-value']) }}')
                        .appendTo($('.category_id').empty())
                        .on('change', function () {
                            column.draw();
                        });
                $('{{ Form::text('author', '', ['class' => 'form-control search-value']) }}')
                        .appendTo($('.author').empty())
                        .on('change', function () {
                            column.draw();
                        });
            });
            $("tfoot tr th:last-child").text("");
        }
    });
</script>
@endpush