
@foreach($allPermissions as $table => $actions)

    <div class="custom-control custom-checkbox ml-2">
        <input 
            class="custom-control-input" 
            type="checkbox" 
            name="table" 
            id="{{$table}}"
            data-table="{{$table}}"
            onchange="selectAll(this)"
            @if(Route::currentRouteName() == "roles.show" )
                    onclick="return false"
            @endif
            @if(isset($data) && !$data->permissions->where('table_name',$table)->isEmpty())
                checked
            @endif 
        >
        <label for="{{$table}}" class="custom-control-label">{{$table}}</label>
    </div>


    @foreach($actions as $permission)

        <div class="custom-control custom-checkbox ml-4">
            <input 
                class="custom-control-input {{$table}}" 
                type="checkbox" 
                name="permissions[]" 
                id="checkbox{{$permission->id}}" 
                value={{$permission->id}}
                @if(Route::currentRouteName() == "roles.show" )
                    onclick="return false"
                @endif
                @if(isset($data) && $data->permissions->pluck('id')->contains($permission->id))
                    checked
                @endif
            >
<label for="checkbox{{$permission->id}}" class="custom-control-label" style='font-weight:400'>{{$permission->title}}</label>
        </div>

    @endforeach 

@endforeach


@section('js')
<script>
        
        function selectAll(e){

            let table = e.dataset.table;

            let checked = e.checked;

            var stockList = $(`.${table}`);

            stockList.each(function() {
                $(this).prop('checked',checked)
            });

        }
</script>
 @parent
@stop