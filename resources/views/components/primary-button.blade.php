<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-12 py-2 bg-[#E8A8B5] border border-transparent rounded-[7px] font-semibold text-2xl text-white uppercase tracking-widest hover:bg-[#D67C8E] focus:bg-[#D67C8E] active:bg-[#D67C8E] focus:outline-none focus:ring-2 focus:ring-[#D67C8E] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
