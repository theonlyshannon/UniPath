@push('plugin-styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}">
@endpush

<div class="table-responsive">
    <table id="dataTableExample" class="table table-striped">
        <thead>
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>

@push('plugin-scripts')
    <script src="{{ asset('admin/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('admin/assets/js/data-table.js') }}"></script>
@endpush
