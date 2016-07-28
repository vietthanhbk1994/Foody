<table class="table table-responsive" id="foods-table">
    <thead>
        <th style="padding-bottom: 15px;">
            ID
        </th>
        <th>
            <div class="row" id="seach-bar">
                Name
                {!! Form::text('name', old('search'), ['placeholder'=>'Search', 'class'=>'search-value']) !!}
            </div>
        </th>
        <th>
            <label for="category">Category</label>
            <div  style="display: inline-flex;">
                {!! Form::select('category_id', $category_ids, null, ['placeholder' => 'Pick one', 'class' => 'form-control search-value']) !!}
            </div>
        </th>
        <th colspan="3">
            Action
            {!! Form::button('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-success','onclick'=>"checkSearch('".URL::to('/foods')."');",'id'=>'btnSearch', 'title'=>'Search']) !!}
        </th>
    </thead>
<tbody>
    @foreach($foods as $food)
    <tr>
        <td>{!! $food->id !!}</td>
        <td>{{ $food->name }}</td>
        <td>{!! $food->category->name !!}</td>
        <td>
            {!! Form::close() !!}
            <div class=''>
                <a href="{!! route('foods.show', [$food->id]) !!}" class='btn btn-default' title="Show detail"><i class="glyphicon glyphicon-eye-open"></i></a>
                @can('admin')
                    {!! Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete','style'=>'display: inline;']) !!}
                        <a href="{!! route('foods.edit', [$food->id]) !!}" class='btn btn-default' title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Do you really want to delete this?')",'title'=>'Delete']) !!}
                    {!! Form::close() !!}
                @endcan
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>