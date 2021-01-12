@php
    $indexroute = get_route($dataType,'index');
    $editroute = get_route($dataType,'edit');
    $destroyroute = get_route($dataType,'destroy');
@endphp


<div class="mt-3 text-right">

    @can(get_gate_action($dataType,'update'))
        <a class="btn btn-info m-1" href="{{ route( $editroute,$arg ) }}">
            <i class="fas fa-pencil-alt">
            </i>
            Edit
        </a>
    @endcan

    @can(get_gate_action($dataType,'delete'))
        <a class="btn btn-danger m-1" href="{{ route( $destroyroute,$arg ) }}">
            <i class="fas fa-trash">
            </i>
            Delete
        </a>
    @endcan

    @can(get_gate_action($dataType,'browse'))
        <a class="btn btn-warning m-1" href="{{ route( $indexroute ) }}">
            <i class="fas fa-list">
            </i>
            Back To List
        </a>
    @endcan

</div>