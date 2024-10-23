<x-filament::page>
    <h1>{{ $pegawai->name }}</h1>
    <p>ID: {{ $pegawai->id }}</p>
    <p>SK Pengangkatan: {{ json_encode($pegawai->sk_pengangkatan) }}</p>
    <p>Data Keluarga: {{ $pegawai->data_keluarga }}</p>
    <p>Data Pendidikan Terakhir: {{ $pegawai->data_pendidikan_terakhir }}</p>
    <!-- Add more fields as necessary -->
</x-filament::page>
