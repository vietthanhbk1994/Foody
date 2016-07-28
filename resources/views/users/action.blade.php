<div class=''>
    {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'name'=>'delete']) }}
    <div class='btn-group'>
        <a href="{{ route('users.show', [$user->id]) }}" class='btn btn-info' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
        <a href="{{ route('users.edit', [$user->id]) }}" class='btn btn-warning' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','title'=>'Delete']) }}
    </div>
    {{ Form::close() }}
</div>