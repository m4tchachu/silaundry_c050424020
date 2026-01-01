<x-filament::page>
    <div class="space-y-6">
        <header class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800">Ringkasan Operasional</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Halo, {{ auth()->user()->name ?? 'Admin' }}</span>
                <img class="h-10 w-10 rounded-full border-2 border-blue-500" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}" alt="Profile">
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-500">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Pesanan</p>
                <p class="text-3xl font-bold text-gray-800">1,250</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-yellow-500">
                <p class="text-gray-500 text-sm font-semibold uppercase">Proses Cuci</p>
                <p class="text-3xl font-bold text-gray-800">45</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-green-500">
                <p class="text-gray-500 text-sm font-semibold uppercase">Selesai</p>
                <p class="text-3xl font-bold text-gray-800">1,180</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-purple-500">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Pendapatan</p>
                <p class="text-3xl font-bold text-gray-800">Rp 12.5M</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Data Pesanan Terbaru</h3>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Pesanan</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <th class="px-6 py-4 font-bold">ID Pesanan</th>
                            <th class="px-6 py-4 font-bold">Pelanggan</th>
                            <th class="px-6 py-4 font-bold">Tgl Masuk</th>
                            <th class="px-6 py-4 font-bold">Berat (Kg)</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold">Total Biaya</th>
                            <th class="px-6 py-4 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-blue-600">PSN001</td>
                            <td class="px-6 py-4 text-gray-700">Budi Santoso</td>
                            <td class="px-6 py-4 text-gray-600">2023-10-24</td>
                            <td class="px-6 py-4 text-gray-600">5</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Proses</span></td>
                            <td class="px-6 py-4 font-bold text-gray-800">Rp 50,000</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a class="text-blue-500 hover:text-blue-700">Lihat</a>
                                <a class="text-red-500 hover:text-red-700">Hapus</a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-blue-600">PSN002</td>
                            <td class="px-6 py-4 text-gray-700">Siti Aminah</td>
                            <td class="px-6 py-4 text-gray-600">2023-10-23</td>
                            <td class="px-6 py-4 text-gray-600">3</td>
                            <td class="px-6 py-4"><span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Selesai</span></td>
                            <td class="px-6 py-4 font-bold text-gray-800">Rp 30,000</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <a class="text-blue-500 hover:text-blue-700">Lihat</a>
                                <a class="text-red-500 hover:text-red-700">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament::page>
