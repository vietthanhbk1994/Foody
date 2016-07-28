
<table class="table table-responsive" id="pages-table">
    {{ Form::open(['route' => 'pages.index', 'method'=>'get']) }}
    <thead>
        <th style="padding-bottom: 15px;">
            ID
        </th>
        <th>
            <div class="row" id="seach-bar">
            Name
            {{ Form::text('search', old('search'), ['placeholder'=>'Search']) }}
            </div>
        </th>
        <th>
            Action
            {{ Form::button('<i class="glyphicon glyphicon-search"></i>', ['type' => 'submit', 'class' => 'btn btn-success', 'title'=>'Search','id'=>'btnSearch']) }}
        </th>
    </thead>
    {{ Form::close() }}
<tbody>
    @foreach($pages as $page)
    <tr>
        <td>{{ $page->id }}</td>
        <td>{{ $page->name }} </td>
        <td>
            <div class=''>
                <a href="{!! route('pages.show', [$page->id]) !!}" class='btn btn-default' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                @can('admin')
                    {{ Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete','style'=>'display: inline;']) }}
                        <a href="{!! route('pages.edit', [$page->id]) !!}" class='btn btn-default' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                    {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Do you really want to delete this?')",'title'=>'Delete']) }}
                    {{ Form::close() }}
                @endcan
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>