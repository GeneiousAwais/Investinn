@if (isset($row))
    <a href="{{ route('project-mentors.edit', $row->id) }}?tab=mentors" class="btn btn-sm btn-success btn-icon waves-effect waves-light d-none">
        <i class="mdi mdi-lead-pencil"></i>
    </a>
    <a href="{{ route('project-mentors.destroy', $row->id) }}" data-table="project-mentor-table"
        class="btn btn-sm btn-danger btn-icon waves-effect  delete-record d-none">
        <i class="ri-delete-bin-5-line"></i>
    </a>
@endif
