<x-layouts.admin title="Tambah Role">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.role.index') }}">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Role</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Role</h6>
                </x-slot>
                <form action="{{ route('admin.role.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <x-forms.input label="Nama Role" name="name" required />

                    <x-forms.input label="Guard Name" name="guard_name" required />

                    <div class="mb-3">
                        <label for="permission">Permission</label>
                        <button type="button" class="btn btn-primary" onclick="addAllPermission()">
                            Tambah Semua Permission
                        </button>
                        <select class="js-example-basic-multiple form-control" id="permission" name="permission[]"
                            multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}">
                                    {{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-ui.base-button color="danger" href="{{ route('admin.role.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Role
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });

            function addAllPermission() {
                var permission = $('#permission option').map(function() {
                    return $(this).val();
                }).get();

                $('#permission').val(permission).trigger('change');
            }
        </script>
    @endpush
</x-layouts.admin>
