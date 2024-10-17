@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'customClass' => '',
    'mb' => '3',
])

@php
    $classes = 'form-control';
    $classes .= $errors->has($name) ? ' is-invalid' : '';
    $classes .= ' ' . $customClass;
@endphp

<div class="mb-{{ $mb }}">

    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif

    @if ($type === 'password')
        <div class="input-group">
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
                placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
                {{ $attributes->merge(['class' => $classes]) }}>

            <div class="input-group-append">
                <span class="input-group-text h-100">
                    <i class="fa fa-eye" id="{{ $id }}-toggle"
                        onclick="togglePassword('{{ $id }}')"></i>
                </span>
            </div>

            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    @endif

    @if ($type !== 'password')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
            {{ $attributes->merge(['class' => $classes]) }}>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endif


</div>

@push('script')
    <script>
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            var eyeIcon = document.getElementById(inputId + '-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
@endpush
