<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => '
        inline-flex items-center justify-center 
        px-4 py-2 
        bg-amber-600 
        hover:bg-amber-700 
        border border-transparent 
        rounded-md 
        font-semibold text-xs text-white 
        uppercase tracking-widest 
        focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2
        transition ease-in-out duration-150'
    ]) }}>
    {{ $slot }}
</button>