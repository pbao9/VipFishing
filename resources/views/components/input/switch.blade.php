<label class="form-check form-switch">
    <input type="checkbox" {{ $attributes->class(['form-check-input']) }} {{ $isChecked($checked) }} value="{{ $value }}">
    <span class="form-check-label">{{ $label }}</span>
</label>
