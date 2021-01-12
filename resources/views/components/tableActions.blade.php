@php
    $showroute = get_route($dataType,'show');
    $editroute = get_route($dataType,'edit');
    $destroyroute = get_route($dataType,'destroy');
@endphp


<td class="project-actions text-right">


    @can(get_gate_action($dataType,'read'))
        <a class="btn btn-primary btn-sm" href="{{ route($showroute,$arg ) }}">
            <i class="fas fa-folder">
            </i>
            View
        </a>
    @endcan

    @can(get_gate_action($dataType,'update'))
        <a class="btn btn-info btn-sm" href="{{ route($editroute,$arg) }}">
            <i class="fas fa-pencil-alt">
            </i>
            Edit
        </a>
    @endcan

    @can(get_gate_action($dataType,'delete'))
        <a class="btn btn-danger btn-sm" href="{{ route($destroyroute,$arg) }}">
            <i class="fas fa-trash">
            </i>
            Delete
        </a>
    @endcan
</td>