<x-main-layout>
    <x-slot name="title">Keranjang Belanja - Tas NoonaHnB</x-slot>

    <section class="hero-gradient py-14 relative">
        <div class="absolute top-0 right-0 w-64 h-64 float-animation" style="background:radial-gradient(circle,rgba(249,115,22,0.07) 0%,transparent 70%);border-radius:50%;"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <p class="text-orange-400 text-sm font-semibold uppercase tracking-widest mb-2">Belanja</p>
            <h1 class="text-4xl font-bold text-white mb-2">Keranjang <span class="text-orange">Belanja</span></h1>
            <div class="divider"></div>
        </div>
    </section>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-6">
            @if($cartItems->count() > 0)
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <form id="checkout-form" action="{{ route('checkout') }}" method="GET" class="hidden"></form>

                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                    <div class="card-dark p-5 flex items-center space-x-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" form="checkout-form" class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-orange-500 focus:ring-orange-500 cart-item-checkbox" data-quantity="{{ $item->quantity }}" data-subtotal="{{ $item->subtotal }}" checked onchange="updateCartSum()">
                        </label>
                        <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-xl flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('products.show', $item->product->slug) }}" class="text-white font-semibold hover:text-orange-400 transition-colors">{{ $item->product->name }}</a>
                            <p class="text-gray-500 text-xs mt-1">{{ $item->product->category->name }}</p>
                            <p class="text-orange-400 font-bold mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                @csrf @method('PATCH')
                                <button type="button" onclick="const qtyInputMinus = this.nextElementSibling; if(qtyInputMinus.value>1){ qtyInputMinus.stepDown(); this.form.submit(); }" class="w-8 h-8 rounded-lg text-white font-bold transition-all hover:scale-110 {{ $item->quantity <= 1 ? 'opacity-40 cursor-not-allowed' : '' }}" style="background:rgba(249,115,22,0.2); border:1px solid rgba(249,115,22,0.3)" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-14 text-center text-white font-bold bg-[#1e2d3d] border border-gray-600 rounded-lg py-1 focus:outline-none focus:border-orange-500 custom-spin-hidden" onchange="this.form.submit()">
                                <button type="button" onclick="const qtyInputPlus = this.previousElementSibling; if(parseInt(qtyInputPlus.value) < parseInt(qtyInputPlus.getAttribute('max'))){ qtyInputPlus.stepUp(); this.form.submit(); }" class="w-8 h-8 rounded-lg text-white font-bold transition-all hover:scale-110 {{ $item->quantity >= $item->product->stock ? 'opacity-40 cursor-not-allowed' : '' }}" style="background:rgba(249,115,22,0.2); border:1px solid rgba(249,115,22,0.3)" {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                            </form>
                        <div class="text-right flex-shrink-0">
                            <p class="text-white font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs transition-colors">Hapus</button>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium transition-colors flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            <span>Kosongkan Keranjang</span>
                        </button>
                    </form>
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="card-dark p-6 sticky top-24">
                        <h2 class="text-white font-bold text-lg mb-5">Ringkasan Pesanan</h2>
                        <div class="space-y-3 mb-5">
                            <div class="flex justify-between text-sm" id="discount-container" style="display: none;">
                                <span class="text-gray-400" id="discount-label">{{ $discountSettings['label'] }} {{ $discountSettings['percentage'] > 0 ? '('.$discountSettings['percentage'].'%)' : '' }}</span>
                                <span class="text-green-400 font-semibold" id="sum-discount">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Ongkir</span>
                                <span class="text-white font-semibold" id="sum-shipping">
                                    @if($shippingCost == 0) <span class="text-green-400">GRATIS</span> @else Rp {{ number_format($shippingCost, 0, ',', '.') }} @endif
                                </span>
                            </div>
                            <div id="free-shipping-msg" class="px-3 py-2 rounded-xl text-xs font-medium" style="background: rgba(249,115,22,0.1); border: 1px solid rgba(249,115,22,0.2); color: #fdba74;">
                                @if($subtotal >= 200000)
                                    🎉 Selamat! Anda mendapat gratis ongkir
                                @else
                                    💡 Belanja Rp <span id="sum-lacking">{{ number_format(200000 - $subtotal, 0, ',', '.') }}</span> lagi untuk gratis ongkir
                                @endif
                            </div>
                        </div>
                        <div class="border-t pt-4 mb-5" style="border-color:rgba(249,115,22,0.15)">
                            <div class="flex justify-between items-center">
                                <span class="text-white font-bold">Total</span>
                                <span class="text-2xl font-bold text-orange-400" id="sum-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <button type="submit" form="checkout-form" id="checkout-btn" class="btn-orange block w-full text-center py-4 rounded-xl font-bold text-lg">Checkout (<span id="btn-qty">{{ $cartItems->sum('quantity') }}</span>)</button>
                        <a href="{{ route('products.index') }}" class="block w-full text-center text-gray-400 hover:text-orange-400 mt-4 text-sm font-medium transition-colors">← Lanjut Belanja</a>
                    </div>
                </div>
            </div>
            @else
            <div class="card-dark p-16 text-center max-w-lg mx-auto">
                <div class="w-24 h-24 rounded-2xl mx-auto mb-6 flex items-center justify-center" style="background:rgba(249,115,22,0.1)">
                    <svg class="w-12 h-12 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h2 class="text-white text-2xl font-bold mb-3">Keranjang Kosong</h2>
                <p class="text-gray-500 mb-8">Yuk, mulai belanja dan temukan tas impian Anda!</p>
                <a href="{{ route('products.index') }}" class="btn-orange px-8 py-4 rounded-xl font-semibold inline-block">Mulai Belanja</a>
            </div>
            @endif
        </div>
    </section>

    <script>
        function updateCartSum() {
            const checkboxes = document.querySelectorAll('.cart-item-checkbox:checked');
            let subtotal = 0;
            let qty = 0;

            checkboxes.forEach(cb => {
                subtotal += parseFloat(cb.dataset.subtotal);
                qty += parseInt(cb.dataset.quantity);
            });

            const discountThreshold = parseFloat('{{ $discountSettings["threshold"] }}');
            const discountPercentage = parseFloat('{{ $discountSettings["percentage"] }}');
            const discountLabel = '{{ $discountSettings["label"] }}';

            let discount = 0;
            if (discountPercentage > 0 && subtotal >= discountThreshold) {
                discount = subtotal * (discountPercentage / 100);
            }

            let shipping = 0;
            if (subtotal > 0 && subtotal < 200000) shipping = 50000;

            let total = subtotal - discount + shipping;

            const formatRp = (num) => 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            document.getElementById('sum-qty').innerText = qty;
            document.getElementById('btn-qty').innerText = qty;
            document.getElementById('sum-subtotal').innerText = formatRp(subtotal);
            
            const discCont = document.getElementById('discount-container');
            if (discount > 0) {
                discCont.style.display = 'flex';
                document.getElementById('discount-label').innerText = discountLabel + (discountPercentage > 0 ? ' (' + discountPercentage + '%)' : '');
                document.getElementById('sum-discount').innerText = '- ' + formatRp(discount);
            } else {
                discCont.style.display = 'none';
            }

            const shipEl = document.getElementById('sum-shipping');
            if (subtotal === 0) {
                shipEl.innerHTML = formatRp(0);
            } else if (shipping === 0) {
                shipEl.innerHTML = '<span class="text-green-400">GRATIS</span>';
            } else {
                shipEl.innerText = formatRp(shipping);
            }

            const freeMsg = document.getElementById('free-shipping-msg');
            if (subtotal >= 200000 || subtotal === 0) {
                freeMsg.style.background = 'rgba(34,197,94,0.1)';
                freeMsg.style.borderColor = 'rgba(34,197,94,0.2)';
                freeMsg.style.color = '#86efac';
                freeMsg.innerHTML = subtotal === 0 ? 'Pilih produk untuk dicheckout' : '🎉 Selamat! Anda mendapat gratis ongkir';
            } else {
                freeMsg.style.background = 'rgba(249,115,22,0.1)';
                freeMsg.style.borderColor = 'rgba(249,115,22,0.2)';
                freeMsg.style.color = '#fdba74';
                freeMsg.innerHTML = '💡 Belanja ' + formatRp(200000 - subtotal) + ' lagi untuk gratis ongkir';
            }

            document.getElementById('sum-total').innerText = formatRp(total);

            const btn = document.getElementById('checkout-btn');
            if (qty >= 50) {
                btn.type = 'button';
                btn.removeAttribute('form');
                btn.innerHTML = 'Checkout Reseller via WhatsApp (' + qty + ')';
                btn.className = 'w-full text-center py-4 rounded-xl font-bold text-lg text-white shadow-lg transition-colors bg-[#25D366] hover:bg-[#128C7E]';
                const msg = encodeURIComponent(`Halo Admin, saya tertarik menjadi Reseller Tas NoonaHnB. Saya ingin checkout keranjang saya dengan total ${qty} buah tas, subtotal ${formatRp(total)}.`);
                btn.onclick = () => {
                    window.open(`https://wa.me/6289616392586?text=${msg}`, '_blank');
                };
                btn.disabled = false;
                btn.style.opacity = '1';

                if(!window.hasAlertedCartReseller) {
                    window.hasAlertedCartReseller = true;
                    setTimeout(() => {
                        if(confirm("Pesanan Grosir/Reseller (50++ pcs) di Keranjang Anda akan otomatis ditangani melalui WhatsApp Admin!\n\nKlik 'OK' untuk langsung memulai checkout via WhatsApp sekarang.")) {
                            window.open(`https://wa.me/6289616392586?text=${msg}`, '_blank');
                        }
                    }, 50);
                }
            } else {
                btn.type = 'submit';
                btn.setAttribute('form', 'checkout-form');
                btn.innerHTML = 'Checkout (<span id="btn-qty">' + qty + '</span>)';
                btn.className = 'btn-orange block w-full text-center py-4 rounded-xl font-bold text-lg';
                btn.onclick = null;
                btn.disabled = (qty === 0);
                btn.style.opacity = (qty === 0) ? '0.5' : '1';
                window.hasAlertedCartReseller = false;
            }
        }
    </script>
    <style>
        .custom-spin-hidden::-webkit-outer-spin-button,
        .custom-spin-hidden::-webkit-inner-spin-button { -webkit-appearance: none; appearance: none; margin: 0; }
        .custom-spin-hidden[type=number] { -moz-appearance: textfield; appearance: textfield; }
    </style>
</x-main-layout>
