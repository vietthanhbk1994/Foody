<!-- Name xx Field -->
<div class="form-group col-sm-6">
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength'=>'100']) }}
</div>
<div class="clearfix"></div>
<!-- Image Field -->
<div class="form-group col-sm-6">
    {{ Form::label('image', 'Image:') }}
    {{ Form::file('image',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) }}
</div>
<div class="clearfix"></div>
<div class="form-group col-sm-12">
    <img id="img" src="{{ URL::to('/uploads').'/' }}<?php
    if (isset($category))
        echo $category->image;
    else
        echo 'no-image.jpg';
    ?>" class="avatar"/>
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
</div>