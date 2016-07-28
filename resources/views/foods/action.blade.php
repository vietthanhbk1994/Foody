<div class=''>
    <div class=''>
        <a href="{{ route('foods.show', [$food->id]) }}" class='btn btn-info' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
        @can('admin')
        {{ Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete','style'=>'display: inline;', 'name'=>'delete']) }}
        <a href="{{ route('foods.edit', [$food->id]) }}" class='btn btn-warning' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','title'=>'Delete']) }}
        {{ Form::close() }}
        @endcan
    </div>
</div>