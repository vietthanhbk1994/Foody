<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength'=>'100']) !!}
</div>
<div class="clearfix"></div>
<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) !!}
</div>
<div class="clearfix"></div>
<div class="form-group col-sm-6">
    <img id="img" src="{!! URL::to('/uploads').'/' !!}<?php
    if (isset($food))
        echo $food->image;
    else
        echo 'no-image.jpg';
    ?>" class="avatar"/>
</div>
<div class="clearfix"></div>
<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category_id', $category_ids, null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="clearfix"></div>
<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control', 'required', 'id'=>'redactor']) !!}
</div>
<div class="clearfix"></div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('foods.index') !!}" class="btn btn-default">Cancel</a>
</div>
