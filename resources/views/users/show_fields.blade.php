<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <p>{!! $user->username !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <div>
        <img src="{!! URL::to('/uploads').'/'.$user->avatar !!}" class="avatar"/>
    </div>
</div>

<!-- Is Admin Field -->
<div class="form-group">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    <p>
        <?php
        if ($user->is_admin == '1') {
            echo 'Admin';
        } else {
            echo 'User';
        }
        ?>
    </p>
</div>