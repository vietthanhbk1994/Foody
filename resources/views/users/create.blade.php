@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div id='my-error' class=""></div>
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {{ Form::open(['route' => 'users.store','files'=>true,'onsubmit'=>"return checkImage('avatar')"]) }}

                        @include('users.fields')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection
