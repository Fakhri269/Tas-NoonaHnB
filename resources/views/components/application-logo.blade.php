<style>
    .logo-adaptive { mix-blend-mode: multiply; }
    .dark .logo-adaptive { mix-blend-mode: screen; filter: invert(1) grayscale(1) brightness(1.5); }
</style>
<img src="{{ asset('logo.png') }}" alt="Noona H&B Logo" {{ $attributes->merge(['class' => 'w-auto object-contain logo-adaptive']) }}>
