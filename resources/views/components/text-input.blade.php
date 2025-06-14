@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => '
        w-full 
        bg-white/50 
        border-2 border-gray-400/30 
        focus:border-amber-600 
        focus:ring-0 
        text-gray-900 
        placeholder-gray-500
        rounded-md 
        shadow-sm'
]) !!}>