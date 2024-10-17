@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'outline' => false,
    'block' => false,
    'disabled' => false,
    'href' => false,
    'target' => false,
    'icon' => false,
    'icon-side' => 'left',
    'icon-color' => 'primary',
])

@php
    $classes = 'btn';
    $classes .= $outline ? '' : ' btn-' . $color;
    $classes .= ' btn-' . $size;
    $classes .= $outline ? ' btn-outline-' . $color : '';
    $classes .= $block ? ' btn-block' : '';
    $classes .= $icon ? ' btn-icon-' . $iconSide : '';
    $classes .= $disabled ? ' disabled' : '';
    $classes .= $icon ? ' btn-icon-' . $iconColor : '';
@endphp

@if ($href)
    <a href="{{ $href }}" target="{{ $target }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <i class="{{ $icon }} me-2"></i>
        @endif

        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }} {{ $disabled ? 'disabled' : '' }}>

        @if ($icon)
            <i class="{{ $icon }} me-2"></i>
        @endif

        {{ $slot }}
    </button>
@endif
