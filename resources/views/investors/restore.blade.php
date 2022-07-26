@if (isset($row))
    <a href="{{ route('restore-archive-user', $row->id) }}" data-table="investors-data-table"
        class="btn btn-sm btn-warning btn-icon waves-effect  restore-record">
        <i class="mdi mdi-delete-restore"></i>
    </a>
@endif
