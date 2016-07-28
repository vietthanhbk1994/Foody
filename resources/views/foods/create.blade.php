@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Food
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div id='my-error' class=""></div>
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {{ Form::open(['route' => 'foods.store','files'=>true, 'onsubmit'=>"return checkImage('image')"]) }}

                        @include('foods.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@include('layouts.redactor')
@endsection
