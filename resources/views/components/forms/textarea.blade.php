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
    <textarea name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}" {{ $attributes->merge(['class' => $classes]) }} rows="3">{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
