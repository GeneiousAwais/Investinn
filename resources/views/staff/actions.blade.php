@if (isset($row))
    <a href="{{ route('staff.edit', $row->id) }}?tab=personaldetails_edit" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
        <i class="mdi mdi-lead-pencil"></i>
    </a>
    <a href="{{ route('users.destroy', $row->id) }}" data-table="staff-data-table"
        class="btn btn-sm btn-danger btn-icon waves-effect  delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>
@endif
