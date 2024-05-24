@props([
    'name',
    'label' => null,
    'selected' => null,
    'parentClass' => null,
    'placeholder' => null,
    'options' => [],
    'optionsType',
    'objKey' => null,
    'objValue' => null,
    'firstOption' => null,
    'firstOptionValue' => null,
    'required' => 'false',
])

<div class="form-group {{ $parentClass }}">
    <label for="{{ $name }}">{{ $label }} @if ($required === 'true')
            <span class="text-danger">*</span>
        @endif
    </label>
    <select name="{{ $name }}" id="{{ $name }}" {!! $attributes->class(['form-control form-select', $errors->has($name) ? 'is-invalid' : '']) !!}
        @if ($required === 'true') required @endif>
        <option value="">{{ $placeholder }}</option>
        @if ($firstOption)
            <option value="{{ $firstOptionValue == '-' ? '' : $firstOption }}">{{ $firstOption }}</option>
        @endif
        @if ($optionsType == 'array')
            @foreach ($options as $key)
                <option value="{{ $key }}" @selected($key == $selected)>{{ $key }}</option>
            @endforeach
        @elseif ($optionsType == 'assoc')
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" @selected($key == $selected)>{{ $value }}</option>
            @endforeach
        @elseif($optionsType == 'object')
            @foreach ($options as $option)
                <option value="{{ $option->$objKey }}" @selected($option->$objKey == $selected)>{{ $option->$objValue }}</option>
            @endforeach
        @endif

    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
