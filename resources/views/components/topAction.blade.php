<div class="mt-3 text-right">

    @can(get_gate_action($dataType,'create'))

        <a class="btn btn-primary mr-2" href="{{ route(get_route(pluralDatatype($dataType),'create'))}}">
            <i class="fas fa-plus">
            </i>
            Add New
        </a>

    @endcan
    
    @can(get_gate_action($dataType,'delete'))

        <a class="btn btn-danger" href='' id="deleteBtn">
            <i class="fas fa-trash">
            </i>
            Bulk Delete
        </a>
        
    @endcan
</div>