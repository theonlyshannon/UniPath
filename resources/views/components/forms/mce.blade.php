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

<div class="mb-{{ $mb }}">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <textarea id="{{ $id }}" name="{{ $name }}" class="form-control {{ $customClass }}"
        placeholder="{{ $placeholder }}">
        {{ old($name, $value) }}
    </textarea>
</div>

@push('head-scripts')
    <script src="https://cdn.tiny.cloud/1/5nrngs45c667kkrnpia9wu199xapyobjaon2dkct8rws8apa/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#{{ $id }}',
            plugins: 'code table lists link image codesample',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link | image | codesample',
        });
    </script>
@endpush
