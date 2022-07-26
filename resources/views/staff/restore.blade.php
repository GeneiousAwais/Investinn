@if (isset($row))
    <a href="{{ route('restore-archive-staff', $row->id) }}" data-table="archived-staff-data-table"
        class="btn btn-sm btn-warning btn-icon waves-effect  restore-record">
        <i class="mdi mdi-delete-restore"></i>
    </a>
@endif
