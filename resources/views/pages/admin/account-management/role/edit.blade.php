<x-layouts.admin title="Edit role">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.role.index') }}">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit role</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Role</h6>
                </x-slot>
                <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input label="Nama Role" name="name" value="{{ $role->name }}" required />

                    <x-forms.input label="Guard Name" name="guard_name" value="{{ $role->guard_name }}" required />

                    <div class="mb-3">
                        <label class="form-label me-3" for="permission">Permission</label>
                        <a href="javascript:void(0)" onclick="addAllPermission()">Tambah Semua
                            Permission</a>

                        <select class="js-example-basic-multiple form-control" id="permission" name="permission[]"
                            multiple>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}"
                                    @if ($role->permissions->contains($permission->id)) selected @endif>
                                    {{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <x-ui.base-button color="danger" href="{{ route('admin.role.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Role
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
