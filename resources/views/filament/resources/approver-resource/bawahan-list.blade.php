<div class="space-y-4">
    @if($bawahan->isEmpty())
        <div class="text-center py-8 text-gray-500">
            <x-heroicon-o-users class="w-12 h-12 mx-auto mb-3 text-gray-400"/>
            <p>Belum ada bawahan yang terdaftar.</p>
        </div>
    @else
        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 font-medium text-gray-700 dark:text-gray-300">Nama</th>
                        <th class="px-4 py-3 font-medium text-gray-700 dark:text-gray-300">NIP</th>
                        <th class="px-4 py-3 font-medium text-gray-700 dark:text-gray-300">Jabatan</th>
                        <th class="px-4 py-3 font-medium text-gray-700 dark:text-gray-300">Unit</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($bawahan as $pegawai)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($pegawai->profile_photo)
                                        <img src="{{ Storage::url($pegawai->profile_photo) }}" 
                                             alt="{{ $pegawai->nama }}" 
                                             class="w-8 h-8 rounded-full object-cover"/>
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium text-gray-600 dark:text-gray-400">
                                            {{ strtoupper(substr($pegawai->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $pegawai->nama }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $pegawai->NIP }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $pegawai->jabatan->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $pegawai->unit->nama ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Total: <span class="font-medium text-gray-900 dark:text-white">{{ $bawahan->count() }}</span> bawahan
        </div>
    @endif
</div>
