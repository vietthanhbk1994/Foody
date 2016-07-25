<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $food->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $food->name !!}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <div class="form-group">
        <img id="img" src="{!! URL::to('/uploads').'/' !!}<?php
        if (isset($food))
            echo $food->image;
        else
            echo 'no-image.jpg';
        ?>" class="avatar"/>
    </div>
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{!! $food->category->name !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $food->content !!}</p>
</div>

