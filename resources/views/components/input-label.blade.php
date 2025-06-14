@props(['value'])

{{-- Mengubah text-white/90 kembali menjadi text-gray-700 --}}
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    @if ($value ?? null)
        {{ $value }}
    @else
        {{ $slot }}
    @endif
</label>