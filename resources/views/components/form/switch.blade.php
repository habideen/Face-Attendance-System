@props([
    'name',
    'id' => null,
    'label' => null,
    'value' => null,
    'parentClass' => null,
    'required' => 'false',
    'ischecked' => 'false',
])

<div class="{{ $parentClass }}">
    <div class="form-check form-switch form-switch-md" dir="ltr">
        <input {!! $attributes->class(['form-check-input', $errors->has($name) ? 'is-invalid' : '']) !!} type="checkbox" name="{{ $name }}" id="{{ $id != null ? $id : $name }}"
            @if ($required === 'true') required @endif @if ($ischecked === 'true') checked @endif>
        <label class="form-check-label" for="{{ $id != null ? $id : $name }}">{{ $label }} @if ($required === 'true')
                <span class="text-danger">*</span>
            @endif
        </label>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
