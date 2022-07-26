@if (isset($row))
    
    <a href="{{ route('investors-sectors.destroy', $row->id) }}" data-table="investor-sector-data-table"
        class="btn btn-sm btn-danger btn-icon waves-effect  delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>
@endif
