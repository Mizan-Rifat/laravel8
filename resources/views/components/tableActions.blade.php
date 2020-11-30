<td class="project-actions text-right">
    <a class="btn btn-primary btn-sm" href="{{ route($showroute,$arg ) }}">
        <i class="fas fa-folder">
        </i>
        View
    </a>

    <a class="btn btn-info btn-sm" href="{{ route($editroute,$arg) }}">
        <i class="fas fa-pencil-alt">
        </i>
        Edit
    </a>

    <a class="btn btn-danger btn-sm" href="{{ route($destroyroute,$arg) }}">
        <i class="fas fa-trash">
        </i>
        Delete
    </a>
</td>