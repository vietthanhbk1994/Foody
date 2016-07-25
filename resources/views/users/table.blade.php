<table class="table table-responsive" id="user-table">
    <thead>
        <th style="padding-bottom: 15px;">
            ID
        </th>
        <th>
            <div class="row" id="seach-bar">
                Username
                {!! Form::text('username', old('search'), ['placeholder'=>'Search', 'class'=>'search-value']) !!}
            </div>
        </th>
        <th>
            <div class="row" id="seach-bar">
                Email
                {!! Form::text('email', old('search'), ['placeholder'=>'Search', 'class'=>'search-value']) !!}
            </div>
        </th>
        <th>
            <label for="is_admin">IsAdmin</label>
            <div  style="display: inline-flex;">
                {!! Form::select('is_admin', ['1'=>'Admin','2'=>'User'], null, ['placeholder' => 'Pick one','class' => 'form-control search-value']) !!}
            </div>
        </th>
        <th colspan="3">
            Action
            {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-success','onclick'=>"checkSearch('".URL::to('/users')."');", 'title'=>'Search','id'=>'btnSearch']) !!}
        </th>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{!! $user->id !!}</td>
            <td>{!! $user->username !!}</td>
            <td>{!! $user->email !!}</td>
            <td>
                <?php
                if ($user->is_admin == '1') {
                    echo 'Admin';
                } else {
                    echo 'User';
                }
                ?>
            </td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-info' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Do you really want to delete this?')",'title'=>'Delete']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>