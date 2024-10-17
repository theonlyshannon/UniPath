<x-layouts.admin title="Edit Student">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.student.index') }}">Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Student</h6>
                </x-slot>
                <form action="{{ route('admin.student.update', $students->id) }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')
                    <x-forms.input label="Email" name="email" id="email" value="{{ $students->email }}" />

                    <x-forms.input label="Password" name="password" id="password" type="password" />

                    <x-forms.input label="Nama Lengkap" name="name" id="name" value="{{ $students->name }}" />
                    @php
                        $genders = [
                            ['value' => 'male', 'label' => 'Laki-laki'],
                            ['value' => 'female', 'label' => 'Perempuan'],
                        ];
                    @endphp
                    <x-forms.select label="Jenis Kelamin" name="gender" id="gender" :options="$genders" key="value" value="label" selected="{{ $students->gender }}" />

                    <x-forms.input label="Nomor Telepon" name="phone" id="phone" value="{{ $students->phone }}" />

                    <x-forms.input label="Asal Kota" name="city" id="city" value="{{ $students->city }}" />

                    <x-ui.base-button color="danger" href="{{ route('admin.student.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Simpan Perubahan
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
