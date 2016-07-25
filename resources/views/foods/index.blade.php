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
                    @include('foods.table')
            </div>
        </div>
        <!-- Pagination -->
        <div style="float: right;margin-top: -30px;">
            {{ $foods->links() }}
        </div>
    </div>
@endsection
