@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'multiple' => false,
    'error' => null,
    'key' => 'id',
    'value' => 'name',
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror"
        {{ $multiple ? 'multiple' : '' }}>
        @foreach ($options as $option)
            <option value="{{ $option[$key] }}" {{ $selected == $option[$key] ? 'selected' : '' }}>
                {{ $option[$value] }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
