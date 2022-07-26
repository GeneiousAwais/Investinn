
@if (isset($row))

    <a href="{{ route('interests.destroy', $row->id) }}" data-table="interests-table"
        class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>

@endif