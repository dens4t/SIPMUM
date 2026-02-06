<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('profile');
        });

        $pegawai = DB::table('pegawai')->select('id', 'profile', 'profile_photo')->get();

        foreach ($pegawai as $row) {
            if (!empty($row->profile_photo) || empty($row->profile)) {
                continue;
            }

            $profileValue = (string) $row->profile;
            $decoded = json_decode($profileValue, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                if (is_string($decoded) && $decoded !== '') {
                    DB::table('pegawai')->where('id', $row->id)->update([
                        'profile_photo' => $decoded,
                    ]);
                }

                continue;
            }

            if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $profileValue) === 1) {
                DB::table('pegawai')->where('id', $row->id)->update([
                    'profile_photo' => $profileValue,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });
    }
};
