<!-- Username Field -->
<div class="form-group col-sm-6">
    {{ Form::label('username', 'Username:') }}
    {{ Form::text('username', null, ['class' => 'form-control', 'required', 'maxlength'=>'100']) }}
</div>
<div class="clearfix"></div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    <?php 
        $disabled['class']='form-control';
        $disabled['required']='required';
        $disabled['maxlength']='100';
        if(isset($user)) $disabled['disabled']='disabled';
    ?>
    {{ Form::label('email', 'Email:') }}
    {{ Form::email('email', null, $disabled) }}
</div>
<div class="clearfix"></div>
<!-- Avatar Field -->
<div class="form-group col-sm-6">
    {{ Form::label('avatar', 'Avatar:') }}
    {{ Form::file('avatar',array('class' => 'form-control','onchange'=>"checkHinhAnh(this); checkImage('image');", 'accept'=>"image/*")) }}
</div>
<div class="form-group col-sm-12">
    <img id="img" src="{{ URL::to('/uploads').'/' }}<?php
    if (isset($user))
        echo $user->avatar;
    else
        echo 'no-image.jpg';
    ?>" class="avatar"/>
</div>
<div class="clearfix"></div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {{ Form::label('password', 'Password:') }}
    {{ Form::password('password', ['class' => 'form-control','required','maxlength'=>'100','onchange'=>"form.password_confirmation.pattern = this.value;"]) }}
</div>
<div class="clearfix"></div>
<!-- Password Confirmation Field -->
<div class="form-group col-sm-6">
    {{ Form::label('password_confirmation', 'Password Confirmation:') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control','title'=>'Password confirmation wrong']) }}
</div>
<div class="clearfix"></div>
<!-- Is Admin Field -->
<div class="form-group col-sm-6">
    {{ Form::label('is_admin', 'Is Admin:') }}
    {{ Form::select('is_admin', ['1' => 'Admin', '2' => 'User'], null, ['class' => 'form-control']) }}
</div>
<div class="clearfix"></div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
</div>
