<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instruksi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ paymentMethod: '' }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <div class="text-center border-b pb-4">
                        <h3 class="text-2xl font-bold text-gray-800">Selesaikan Pembayaran Anda</h3>
                        <p class="text-gray-500 text-sm">Total Tagihan</p>
                        <p class="text-4xl font-bold text-indigo-600">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</p>
                    </div>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-800">Pilih Metode Pembayaran:</h4>

                        <div class="mt-4 space-y-3">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50" :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'bank_transfer' }">
                                <input type="radio" name="payment_method_display" value="bank_transfer" x-model="paymentMethod" class="text-blue-600 focus:ring-blue-500">
                                <span class="ms-3 font-medium">Bank Transfer</span>
                            </label>
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50" :class="{ 'border-blue-500 bg-blue-50': paymentMethod === 'e_wallet' }">
                                <input type="radio" name="payment_method_display" value="e_wallet" x-model="paymentMethod" class="text-blue-600 focus:ring-blue-500">
                                <span class="ms-3 font-medium">E-Wallet (GoPay/OVO/DANA)</span>
                            </label>
                        </div>
                    </div>

                    {{-- PERBAIKAN ADA DI BARIS INI: style="display: none;" dihapus --}}
                    <div x-show="paymentMethod" class="mt-6 text-left bg-gray-50 p-6 rounded-lg border border-gray-200 transition-all">
                        <div x-show="paymentMethod === 'bank_transfer'">
                            <h4 class="font-semibold text-gray-800">Instruksi Transfer Bank</h4>
                            <ul class="list-disc list-inside mt-2 space-y-2 text-sm">
                                <li><strong>Bank:</strong> Bank Central Asia (BCA)</li>
                                <li><strong>No. Rekening:</strong> 123-456-7890</li>
                                <li><strong>Atas Nama:</strong> PT Hotel Kita Bersama</li>
                            </ul>
                        </div>
                        <div x-show="paymentMethod === 'e_wallet'" class="text-center">
                            <h4 class="font-semibold text-gray-800">Pembayaran via E-Wallet</h4>
                            <p class="text-sm mt-2">Pindai QR Code di bawah ini.</p>
                            <div class="flex justify-center mt-4">
                                <div class="w-40 h-40 bg-gray-300 flex items-center justify-center">QR Code</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-xs text-red-600 mt-4">Status reservasi Anda saat ini adalah "Menunggu Pembayaran". Silahkan datang ke hotel lalu tampilkan bukti pembayaran.</p>
                        <p class="text-xs text-red-600 mt-4">.</p>
                        <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>