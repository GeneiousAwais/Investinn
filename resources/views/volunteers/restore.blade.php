@if (isset($row))
    <a href="{{ route('restore-archive-volunteer', $row->id) }}" data-table="archived-volunteer-data-table"
        class="btn btn-sm btn-warning btn-icon waves-effect  restore-record">
        <i class="mdi mdi-delete-restore"></i>
    </a>
@endif
