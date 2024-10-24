<!-- Footer-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <div class="small text-center text-muted">Copyright &copy; 2023 - Company Name</div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script>
    AOS.init();
    $(document).ready(function() {
        $('#table_nomor_surat').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("permohonan/nomor-surat") }}',
            columns: [{
                    data: 'pegawai.nama',
                    name: 'pegawai.nama'
                },
                {
                    data: 'kode_surat',
                    name: 'kode_surat'
                },
                {
                    data: 'kode_klasifikasi',
                    name: 'kode_klasifikasi'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data) {
                        return new Date(data).toLocaleDateString();
                    }
                },
                {
                    data: 'perihal',
                    name: 'perihal'
                },
            ]
        });
        $('#table_pengajuan_sppd').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("permohonan/pengajuan-sppd") }}',
            columns: [{
                    data: 'pegawai.nama',
                    name: 'pegawai.nama'
                },
                {
                    data: 'jenis_sppd',
                    name: 'jenis_sppd'
                },
                {
                    data: 'tanggal_awal_kegiatan',
                    name: 'tanggal_awal_kegiatan'
                },
                {
                    data: 'judul_kegiatan',
                    name: 'judul_kegiatan'
                },
                {
                    data: 'kota_tujuan',
                    name: 'kota_tujuan'
                },
            ]
        });
        $('#table_pengajuan_kendaraan_dinas').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("permohonan/pengajuan-kendaraan-dinas") }}',
            columns: [
                {
                    data: 'pegawai.nama',
                    name: 'pegawai.nama'
                },
                {
                    data: 'tanggal_pengembalian',
                    name: 'tanggal_pengembalian'
                },
                {
                    data: 'keperluan',
                    name: 'keperluan'
                },
                {
                    data: 'tujuan',
                    name: 'tujuan'
                },
                {
                    data: 'driver.nama',
                    name: 'driver.nama'
                },
                {
                    data: 'kendaraan.jenis_mobil',
                    name: 'kendaraan.jenis_mobil'
                },
            ]
        });
        $('#table_pengajuan_rapat_konsumsi').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("permohonan/pengajuan-rapat-konsumsi") }}',
            columns: [
                {
                    data: 'pegawai.nama',
                    name: 'pegawai.nama'
                },
                {
                    data: 'judul_rapat',
                    name: 'judul_rapat'
                },
                {
                    data: 'tanggal_waktu_mulai',
                    name: 'tanggal_waktu_mulai'
                },
                {
                    data: 'metode',
                    name: 'metode'
                },
                {
                    data: 'ruang',
                    name: 'ruang'
                },
                {
                    data: 'jenis_konsumsi',
                    name: 'jenis_konsumsi'
                },
            ]
        });
    });
</script>
