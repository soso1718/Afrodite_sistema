@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-roboto font-normal text-sm text-[#FFF0F3]']) }}>
    {{ $value ?? $slot }}
</label>
