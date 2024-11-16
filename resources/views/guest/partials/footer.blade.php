<!-- Footer-->

<section class="page-section" data-aos="fade-up" style="background-image:none;background-color:white;">
    <div class="row justify-content-center">
        <div class="col-lg-4 px-lg-5" style="text-align:justify;">
            <p>Sehubungan dengan Keputusan Direksi PT PLN Nusantara Power di Luar Rapat Direksi (Sirkuler) Nomor 046/DIR/2023 tanggal 27 November 2023 tentang Perubahan Organisasi Unit PT PLN Nusantara Power Tahun 2023. Berdasarkan surat Legal dan Manajemen Human Capital PT PLN (Persero) Nomor 0030/ORG.00.02/F01080000/2024-R tanggal 2 Januari 2024 tentang Persetujuan Perubahan Struktur Organisasi dan Position Grade Unit Pembangkitan PT PLN Nusantara Power.</p>
        </div>
        <div class="col-lg-2">
            <div class="row ">
                <div class="col-lg-12">
                    <h4> <i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                    <p class="text-muted">Jl. Adi Sucipto No.2, Sungai Raya, Kec. Sungai Raya, Kabupaten Kubu Raya, Kalimantan Barat 78117</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4><i class="bi bi-stopwatch-fill"></i> Jam Kerja</h4>
                    <p>Senin s/d Jumat<br>
                        <span class="text-muted"> 07:30 sd 16:00 WIB</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-person-lines-fill"></i> Kontak</h4>
            <p><i class="bi bi-telephone-fill"></i>Phone<br>
                <span class="text-muted">(0561) 723472 ext. 723449</span>
            </p>
            <p><i class="bi bi-envelope-fill"></i> Email<br>
                <span class="text-muted"> ptplnnpupks@gmail.com</span>
            </p>
        </div>
        <div class="col-lg-2">
            <h4><i class="bi bi-pin-map"> </i>Kantor Pusat</h4>
            <h4>PT PLN Nusantara Power Kantor Pusat</h4>
            <p class="text-muted">Jl. Ketintang Baru No. 11,
                Surabaya, Indonesia</p>
            <h4>Kantor Strategis</h4>
            <p class="text-muted">PT PLN Nusantara Power Office Strategis, 18 Office Park, Lt.2 ABCD
                Jl. TB Simatupang No.18 Jakarta Selatan, DKI Jakarta Indonesia</p>
        </div>
    </div>
</section>

<script>
    const loadTime = () => {
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
        else(a = tw.getTime());
        tw.setTime(a);
        var tahun = tw.getFullYear();
        var hari = tw.getDay();
        var bulan = tw.getMonth();
        var tanggal = tw.getDate();
        var hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jum'at,", "Sabtu,");
        var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember");
        console.log(hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + " " + tahun + " Jam " + ((tw.getHours() < 10) ? "0" : "") + tw.getHours() + ":" + ((tw.getMinutes() < 10) ? "0" : "") + tw.getMinutes() + (" W.I.B "));
        // document.getElementById("tanggalwaktu").innerHTML = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + " " + tahun + " Jam " + ((tw.getHours() < 10) ? "0" : "") + tw.getHours() + ":" + ((tw.getMinutes() < 10) ? "0" : "") + tw.getMinutes() + ":" + ((tw.getSeconds() < 10) ? "0" : "") + tw.getSeconds() + (" W.I.B ");
        document.getElementById("tanggalwaktu").innerHTML = hariarray[hari] + " " + tanggal + " " + bulanarray[bulan] + " " + tahun ;
    }
    loadTime();
    setInterval(() => {
        loadTime();
    }, 1000);
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <div class="small text-center text-muted">Copyright &copy; 2024 - PLN</div>
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
                    data: 'kota_tujuan.nama',
                    name: 'kota_tujuan.nama'
                },
            ]
        });
        $('#table_pengajuan_kendaraan_dinas').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("permohonan/pengajuan-kendaraan-dinas") }}',
            columns: [{
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
            columns: [{
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
