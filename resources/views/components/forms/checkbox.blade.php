@props([
    'name',
    'label',
    'checked' => false,
    'error' => null,
])

<div class="mb-3 form-check">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" class="form-check-input @error($name) is-invalid @enderror"
        {{ $checked ? 'checked' : '' }}>
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
