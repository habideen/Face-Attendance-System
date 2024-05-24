@props([
    'name',
    'label' => null,
    'value' => null,
    'parentClass' => null,
    'bottomInfo' => null,
    'required' => 'false',
])

<div class="form-group {{ $parentClass }}">
    <label for="{{ $name }}">{{ $label }} @if ($required === 'true')
            <span class="text-danger">*</span>
        @endif
    </label>
    <input name="{{ $name }}" id="{{ $name }}" {!! $attributes->class(['form-control', $errors->has($name) ? 'is-invalid' : '']) !!} value="{{ $value }}"
        @if ($required === 'true') required @endif>
    <div class="text-muted">{!! $bottomInfo !!}</div>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
