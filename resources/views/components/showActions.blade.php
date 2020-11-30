<div class="mt-3 text-right">

    <a class="btn btn-info m-1" href="{{ route( $editroute,$arg ) }}">
        <i class="fas fa-pencil-alt">
        </i>
        Edit
    </a>

    <a class="btn btn-danger m-1" href="{{ route( $destroyroute,$arg ) }}">
        <i class="fas fa-trash">
        </i>
        Delete
    </a>
    <a class="btn btn-warning m-1" href="{{ route( $indexroute ) }}">
        <i class="fas fa-list">
        </i>
        Back To List
    </a>
</div>