<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Total Investments {{ isset($investor_investment_total) ? number_format($investor_investment_total): 0}}$</h4>
            </div>

            <div class="card-body">

                <table id="project-investments-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('header_scripts')

@endpush

@push('footer_scripts')

<script type="text/javascript">
    $(document).ready(function() {

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#project-investments-table').DataTable({
            retrieve: true,
            processing: true,
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
            responsive: true,
            bLengthChange: false,
            pageLength: 10,
            scrollX: true,
            ajax: {
                url: "{{ route('project-investors.index') }}",
                data: function ( d ) {
                    d.investor_id = "{{isset($user_info) ? $user_info->id : ''}}";

                }
            },

            columns: [

            {
                data: 'id',
                name: 'id',
                width: "5%"
            },
            {
                data: 'projects.project_title',
                name: 'projects.project_title'
            },
            {
                data: 'invest_amount',
                name: 'invest_amount'
            }
            ]
        });
    });
</script>

@endpush
