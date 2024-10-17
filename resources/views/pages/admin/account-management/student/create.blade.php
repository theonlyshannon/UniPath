<x-layouts.admin title="Tambah Student">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.student.index') }}">Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Student</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Student</h6>
                </x-slot>
                <form action="{{ route('admin.student.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    <x-forms.input label="Email" name="email" id="email" />

                    <x-forms.input label="Password" name="password" id="password" type="password" />

                    <x-forms.input label="Nama Lengkap" name="name" id="name" />
                    @php
                        $genders = [
                            ['value' => 'male', 'label' => 'Laki-laki'],
                            ['value' => 'female', 'label' => 'Perempuan'],
                        ];
                    @endphp
                    <x-forms.select label="Jenis Kelamin" name="gender" id="gender" :options="$genders" key="value"
                        value="label" />

                    <x-forms.input label="Nomor Telepon" name="phone" id="phone" />

                    <x-forms.input label="Asal Kota" name="city" id="city" />

                    <x-ui.base-button color="danger" href="{{ route('admin.student.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Student
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>


</x-layouts.admin>
