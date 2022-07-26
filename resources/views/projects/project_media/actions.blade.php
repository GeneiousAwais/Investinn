@if (isset($row))
    <a href="{{ route('project-media.edit', $row->id) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light d-none">
        <i class="mdi mdi-lead-pencil"></i>
    </a>
    <a href="{{ route('project-media.destroy', $row->id) }}" data-table="project-media-data-table"
        class="btn btn-sm btn-danger btn-icon waves-effect  delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>
@endif
