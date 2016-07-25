<table class="table table-responsive" id="categories-table">
    {!! Form::open(['route' => 'categories.index', 'method'=>'get']) !!}
    <thead>
        <th style="padding-bottom: 15px;">
            ID
        </th>
        <th>
            <div class="row" id="seach-bar">
                Name
                {!! Form::text('search', old('search'), ['placeholder'=>'Search']) !!}
            </div>
        </th>
        <th colspan="3">
            Action
            {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['type' => 'submit', 'class' => 'btn btn-success', 'title'=>'Search','id'=>'btnSearch']) !!}
        </th>
    </thead>
    {!! Form::close() !!}
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{!! $category->id !!}</td>
            <td>{!! $category->name !!}</td>
            <td>
                <div class=''>
                    <a href="{!! route('categories.show', [$category->id]) !!}" class='btn btn-default' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                    @can('admin')
                    {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete','style'=>'display: inline;']) !!}
                        <a href="{!! route('categories.edit', [$category->id]) !!}" class='btn btn-default' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Do you really want to delete this?')",'title'=>'Delete']) !!}
                    {!! Form::close() !!}
                    @endcan
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>