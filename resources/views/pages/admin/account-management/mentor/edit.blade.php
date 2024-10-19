<x-layouts.admin title="Edit Mentor">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.mentor.index') }}">Mentor</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Mentor</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Mentor</h6>
                </x-slot>
                <form action="{{ route('admin.mentor.update', $mentor->id) }}" method="POST"
                    enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')

                    @if ($mentor->profile_picture)
                        <img src="{{ asset($mentor->profile_picture) }}" style="max-height: 200px; object-fit: contain;"
                            class="mb-3" id="profile-picture-preview">
                    @else
                        <img src="" style="max-height: 200px; object-fit: contain;" class="d-none mb-3"
                            id="profile-picture-preview">
                    @endif

                    <x-forms.input label="Foto Profil" name="profile_picture" id="profile_picture" type="file" />

                    <x-forms.input label="Email" name="email" id="email"
                        value="{{ old('email', $mentor->user->email) }}" />

                    <x-forms.input label="Password" name="password" id="password" type="password" />

                    <x-forms.input label="Nama Lengkap" name="name" id="name"
                        value="{{ old('name', $mentor->name) }}" />

                    <x-forms.input label="Gelar" name="degree" id="degree"
                        value="{{ old('degree', $mentor->degree) }}" />

                    @php
                        $genders = [
                            ['value' => 'male', 'label' => 'Laki-laki'],
                            ['value' => 'female', 'label' => 'Perempuan'],
                        ];
                    @endphp

                    <x-forms.select label="Jenis Kelamin" name="gender" id="gender" :options="$genders" key="value"
                        value="label" />

                    <x-forms.input label="Nomor Telepon" name="phone" id="phone"
                        value="{{ old('phone', $mentor->phone) }}" />

                    <x-forms.input label="Asal Kota" name="city" id="city"
                        value="{{ old('city', $mentor->city) }}" />

                    <x-forms.textarea label="Bio" name="bio" id="bio"
                        value="{{ old('bio', $mentor->bio) }}" />

                    <x-ui.base-button color="danger" href="{{ route('admin.mentor.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Mentor
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            const profilePicture = document.querySelector('#profile_picture');
            const profilePicturePreview = document.querySelector('#profile-picture-preview');

            profilePicture.addEventListener('change', function() {
                const file = profilePicture.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    profilePicturePreview.src = e.target.result;
                    profilePicturePreview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            });
        </script>
    @endpush
</x-layouts.admin>
