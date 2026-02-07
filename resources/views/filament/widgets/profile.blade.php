<div class="fi-section-content-ctn flex items-center p-6 bg-white rounded-lg shadow-md">
    <div class="flex-shrink-0 fi-section-content-ctn">
        @php
            $user = auth()->user();
            $profilePhoto = $user?->pegawai?->profile_photo;
            $legacyProfile = $user?->pegawai?->profile;
            $profile = null;

            if (! empty($profilePhoto)) {
                $profilePhotoPath = trim((string) $profilePhoto);

                if ($profilePhotoPath !== '' && \Illuminate\Support\Facades\Storage::disk('public')->exists($profilePhotoPath)) {
                    $profile = url('storage/' . $profilePhotoPath);
                }
            }

            if (! $profile) {
                $legacyPath = null;

                if (is_array($legacyProfile) && ! empty($legacyProfile)) {
                    $legacyPath = reset($legacyProfile);
                } elseif (is_string($legacyProfile) && $legacyProfile !== '') {
                    $legacyPath = $legacyProfile;
                }

                if (! empty($legacyPath)) {
                    $legacyPath = trim((string) $legacyPath);

                    if (
                        preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $legacyPath) === 1
                        && \Illuminate\Support\Facades\Storage::disk('public')->exists($legacyPath)
                    ) {
                        $profile = url('storage/' . $legacyPath);
                    }
                }

            }

            if (! $profile) {
                $words = collect(explode(' ', trim((string) ($user?->name ?? ''))))
                    ->filter(fn (string $word): bool => $word !== '')
                    ->take(2)
                    ->map(fn (string $word): string => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($word, 0, 1)));

                $initials = $words->isNotEmpty() ? $words->implode('') : 'NA';

                $svg = "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'>"
                    . "<rect width='64' height='64' rx='32' fill='#dbe4f0'/>"
                    . "<text x='50%' y='50%' dominant-baseline='central' text-anchor='middle' font-family='Arial, sans-serif' font-size='22' font-weight='700' fill='#243447'>"
                    . e($initials)
                    . '</text></svg>';

                $profile = 'data:image/svg+xml;base64,' . base64_encode($svg);
            }
        @endphp
        <img
            src="{{ $profile }}"
            alt="Profile Avatar"
            style="width:160px;height:160px;" class="rounded-full border border-gray-300">
    </div>
    <div class="ml-4 fi-section-content-ctn" style="margin-left:20px;" data-aos="zoom-in-up">
        <h2 class="text-xl font-semibold text-black text-underline">{{ auth()->user()->name }}</h2>
        <div class="mt-2">
            <p style="color:grey;">NIP: <span style="color:black">{!! auth()->user()->pegawai->NIP ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Tanggal Masuk: <span style="color:black">{!! auth()->user()->pegawai->tanggal_mulai ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Jabatan: <span style="color:black">{!! auth()->user()->pegawai->jabatan->nama ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="color:grey;">Unit: <span style="color:black">{!! auth()->user()->pegawai->unit->nama_lengkap ?? '<span style="font-style:italic;color:grey">Belum Disesuaikan</span>' !!}</span></p>
            <p style="margin-top:20px;color:grey;">Terakhir Login: <span style="color:black">{{ auth()->user()->last_login_at?->diffForHumans() ??  '' }}</span></p>
        </div>
    </div>

</div>
