<div class="flex items-center p-6 bg-white rounded-lg shadow-md">
    <div class="flex-shrink-0">
        <img
            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=075596&color=fff"
            alt="Profile Avatar"
            style="width:160px;height:160px;" class="rounded-full border border-gray-300">
    </div>
    <div class="ml-4" style="margin-left:20px;">
        <h2 class="text-xl font-semibold text-black text-underline">{{ auth()->user()->name }}</h2>
        <div class="mt-2">
            <p style="color:grey;">NIP: <span style="color:black">{!! auth()->user()->pegawai->NIP ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Tanggal Masuk: <span style="color:black">{!! auth()->user()->pegawai->tanggal_mulai ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Jabatan: <span style="color:black">{!! auth()->user()->pegawai->jabatan->nama ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Unit: <span style="color:black">{!! auth()->user()->pegawai->unit->nama ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="margin-top:20px;color:grey;">Terakhir Login: <span style="color:black">{{ auth()->user()->last_login_date ??  '' }}</span></p>
        </div>
    </div>

</div>
