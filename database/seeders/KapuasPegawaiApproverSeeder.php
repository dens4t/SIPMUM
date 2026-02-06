<?php

namespace Database\Seeders;

use RuntimeException;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Approver;
use App\Models\ApproverCategory;
use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\PendidikanTerakhir;
use App\Models\Unit;

class KapuasPegawaiApproverSeeder extends Seeder
{
    private const SOURCE_FILE = 'database/seeders/data/kapuas_employees.tsv';

    public function run(): void
    {
        $rows = $this->readRows();

        DB::transaction(function () use ($rows) {
            $this->seedMasterData($rows);

            [$pegawaiByNid, $nidByPosition] = $this->seedPegawai($rows);
            $this->updateAtasanPegawai($rows, $pegawaiByNid, $nidByPosition);
            $this->seedApprovers($rows, $pegawaiByNid);
        });
    }

    private function readRows(): array
    {
        $path = base_path(self::SOURCE_FILE);
        if (!is_file($path)) {
            throw new RuntimeException('Sumber data belum ada: '.self::SOURCE_FILE);
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES);
        if ($lines === false || count($lines) < 2) {
            throw new RuntimeException('File sumber kosong atau tidak valid.');
        }

        $delimiter = str_contains($lines[0], "\t") ? "\t" : ',';
        $headers = array_map(fn ($value) => trim((string) $value), str_getcsv((string) $lines[0], $delimiter));

        $rows = [];
        for ($i = 1; $i < count($lines); $i++) {
            $line = trim((string) $lines[$i]);
            if ($line === '') {
                continue;
            }

            $values = array_map(fn ($value) => trim((string) $value), str_getcsv($line, $delimiter));
            if (count($values) !== count($headers)) {
                continue;
            }

            $rows[] = array_combine($headers, $values);
        }

        if (empty($rows)) {
            throw new RuntimeException('Tidak ada baris data yang valid pada sumber import.');
        }

        return $rows;
    }

    private function seedMasterData(array $rows): void
    {
        $pendidikanOrder = [
            'SMA' => 1,
            'SMK' => 1,
            'D1' => 2,
            'D2' => 3,
            'D3' => 4,
            'D4' => 5,
            'S1' => 6,
            'S2' => 7,
            'S3' => 8,
        ];

        foreach ($rows as $row) {
            $unitName = $this->pickUnitName($row);
            Unit::query()->updateOrCreate(
                ['nama' => $unitName],
                ['jenis' => $this->inferJenisUnit($unitName)]
            );

            $bagianName = $this->normalizeWhitespace((string) ($row['BIDANG'] ?? $row['DIREKTORAT'] ?? '-'));
            Bagian::query()->updateOrCreate(
                ['nama' => $bagianName],
                [
                    'jenis' => 'bagian',
                    'nama_lengkap' => 'Bagian '.$bagianName,
                ]
            );

            $jabatanName = $this->normalizeWhitespace((string) ($row['POSISI'] ?? '-'));
            Jabatan::query()->updateOrCreate(['nama' => $jabatanName], []);

            $pendidikan = strtoupper($this->normalizeWhitespace((string) ($row['PENDIDIKAN'] ?? 'SMA')));
            $prefix = strtok($pendidikan, ' ');
            $urutan = $pendidikanOrder[$prefix] ?? 1;
            PendidikanTerakhir::query()->updateOrCreate(
                ['jenjang' => $pendidikan],
                ['urutan' => $urutan]
            );
        }
    }

    private function seedPegawai(array $rows): array
    {
        $pegawaiByNid = [];
        $nidByPosition = [];

        foreach ($rows as $row) {
            $nid = trim((string) ($row['NID'] ?? ''));
            if ($nid === '') {
                continue;
            }

            $unitName = $this->pickUnitName($row);
            $bagianName = $this->normalizeWhitespace((string) ($row['BIDANG'] ?? $row['DIREKTORAT'] ?? '-'));
            $jabatanName = $this->normalizeWhitespace((string) ($row['POSISI'] ?? '-'));
            $pendidikan = strtoupper($this->normalizeWhitespace((string) ($row['PENDIDIKAN'] ?? 'SMA')));

            $unit = Unit::query()->where('nama', $unitName)->first();
            $bagian = Bagian::query()->where('nama', $bagianName)->first();
            $jabatan = Jabatan::query()->where('nama', $jabatanName)->first();
            $pendidikanTerakhir = PendidikanTerakhir::query()->where('jenjang', $pendidikan)->first();

            $pegawai = Pegawai::query()->updateOrCreate(
                ['NIP' => $nid],
                [
                    'nama' => $this->normalizeWhitespace((string) ($row['NAMA_LENGKAP'] ?? '')),
                    'jenis_kelamin' => $this->mapJenisKelamin((string) ($row['JENIS_KELAMIN'] ?? 'Laki')),
                    'alamat_lengkap' => $this->normalizeWhitespace((string) ($row['ALAMAT_KTP'] ?? '')),
                    'kota' => $this->normalizeWhitespace((string) ($row['KOTA_KTP'] ?? '')),
                    'person_grade' => trim((string) ($row['GRADE'] ?? '')),
                    'position_grade' => trim((string) ($row['JOBGRADE'] ?? '')),
                    'jenjang_jabatan' => $this->normalizeWhitespace((string) ($row['JENJANG_JABATAN'] ?? '')),
                    'tanggal_grade' => $this->parseDate((string) ($row['TGL_GRADE'] ?? '')),
                    'tanggal_mulai' => $this->parseDate((string) ($row['TGL_MULAI'] ?? '')),
                    'jabatan_lengkap' => $this->normalizeWhitespace((string) ($row['JABATAN_LENGKAP'] ?? '')),
                    'tanggal_masuk' => $this->parseDate((string) ($row['HIRE_DATE'] ?? '')),
                    'tanggal_lahir' => $this->parseDate((string) ($row['TGL_LAHIR'] ?? '')),
                    'id_pendidikan_terakhir' => $pendidikanTerakhir?->id,
                    'id_jabatan' => $jabatan?->id,
                    'id_bagian' => $bagian?->id,
                    'id_unit' => $unit?->id,
                    'profile' => [
                        'mims_id' => trim((string) ($row['MIMS_ID'] ?? '')),
                        'position_id' => trim((string) ($row['POSITION_ID'] ?? '')),
                        'superior_id' => trim((string) ($row['SUPERIOR_ID'] ?? '')),
                        'direktorat' => $this->normalizeWhitespace((string) ($row['DIREKTORAT'] ?? '')),
                        'bidang' => $this->normalizeWhitespace((string) ($row['BIDANG'] ?? '')),
                        'sub_bidang' => $this->normalizeWhitespace((string) ($row['SUB_BIDANG'] ?? '')),
                        'ulpl' => $this->normalizeWhitespace((string) ($row['ULPL'] ?? '')),
                        'agama' => $this->normalizeWhitespace((string) ($row['AGAMA'] ?? '')),
                    ],
                ]
            );

            $pegawaiByNid[$nid] = $pegawai->id;

            $positionId = trim((string) ($row['POSITION_ID'] ?? ''));
            if ($positionId !== '') {
                $nidByPosition[$positionId] = $nid;
            }
        }

        return [$pegawaiByNid, $nidByPosition];
    }

    private function updateAtasanPegawai(array $rows, array $pegawaiByNid, array $nidByPosition): void
    {
        $missingSuperiors = [];
        $externalSuperiors = [];

        foreach ($rows as $row) {
            $nid = trim((string) ($row['NID'] ?? ''));
            $superiorPositionId = trim((string) ($row['SUPERIOR_ID'] ?? ''));

            if ($nid === '' || $superiorPositionId === '' || !isset($pegawaiByNid[$nid])) {
                continue;
            }

            if (str_starts_with($superiorPositionId, 'ZZ')) {
                $externalSuperiors[$nid] = $superiorPositionId;
                continue;
            }

            $superiorNid = $this->resolveSuperiorNid($superiorPositionId, $nidByPosition);
            if (!$superiorNid || !isset($pegawaiByNid[$superiorNid])) {
                $missingSuperiors[$nid] = $superiorPositionId;
                continue;
            }

            Pegawai::query()->whereKey($pegawaiByNid[$nid])->update([
                'id_atasan' => $pegawaiByNid[$superiorNid],
            ]);
        }

        if (!empty($externalSuperiors)) {
            $this->command?->warn('Atasan eksternal (prefix ZZ) untuk '.count($externalSuperiors).' pegawai diset null.');
        }

        if (!empty($missingSuperiors)) {
            $this->command?->warn('Supervisor tidak ditemukan untuk '.count($missingSuperiors).' pegawai.');

            foreach ($missingSuperiors as $pegawaiNid => $superiorPositionId) {
                $this->command?->warn("- {$pegawaiNid} -> {$superiorPositionId}");
            }
        }
    }

    private function seedApprovers(array $rows, array $pegawaiByNid): void
    {
        $categories = ApproverCategory::query()->where('is_active', true)->pluck('id', 'nama_kategori')->all();
        if (empty($categories)) {
            throw new RuntimeException('Kategori approver belum tersedia. Jalankan ApproverCategorySeeder terlebih dahulu.');
        }

        $candidatesByCategory = [];
        foreach ($rows as $row) {
            $categoryName = $this->resolveApproverCategory($row);
            if (!$categoryName || !isset($categories[$categoryName])) {
                continue;
            }

            $nid = trim((string) ($row['NID'] ?? ''));
            if ($nid === '' || !isset($pegawaiByNid[$nid])) {
                continue;
            }

            $candidatesByCategory[$categoryName][] = $row;
        }

        $selectedByCategory = [];
        foreach ($candidatesByCategory as $categoryName => $candidates) {
            usort($candidates, function (array $left, array $right): int {
                $leftDate = (string) ($left['TGL_JABATAN'] ?? '');
                $rightDate = (string) ($right['TGL_JABATAN'] ?? '');
                return $rightDate <=> $leftDate;
            });

            $selectedByCategory[$categoryName] = $candidates[0];
        }

        $fallbackCategorySources = [
            'Asman Enjiniring' => [
                'Team Leader CBM',
                'Team Leader MMRK',
                'Team Leader System Owner',
            ],
            'Team Leader Inventory dan Kontrol' => [
                'Team Leader Outage',
                'Team Leader Rendal HAR',
            ],
        ];

        foreach ($fallbackCategorySources as $missingCategory => $sourceCategories) {
            if (isset($selectedByCategory[$missingCategory])) {
                continue;
            }

            foreach ($sourceCategories as $sourceCategory) {
                if (isset($selectedByCategory[$sourceCategory])) {
                    $selectedByCategory[$missingCategory] = $selectedByCategory[$sourceCategory];
                    break;
                }
            }
        }

        $parentMap = $this->approverParentMap();
        $pegawaiByCategory = [];
        foreach ($selectedByCategory as $categoryName => $row) {
            $nid = trim((string) $row['NID']);
            $pegawaiByCategory[$categoryName] = $pegawaiByNid[$nid] ?? null;
        }

        $selectedPairs = [];

        foreach ($selectedByCategory as $categoryName => $row) {
            $nid = trim((string) $row['NID']);
            $idPegawai = $pegawaiByNid[$nid] ?? null;
            if (!$idPegawai) {
                continue;
            }

            $parentCategory = $parentMap[$categoryName] ?? null;
            $idAtasan = $parentCategory ? ($pegawaiByCategory[$parentCategory] ?? null) : null;

            if (!$idAtasan) {
                $idAtasan = Pegawai::query()->whereKey($idPegawai)->value('id_atasan');
            }

            Approver::query()->updateOrCreate(
                [
                    'id_pegawai' => $idPegawai,
                    'id_approver_category' => $categories[$categoryName],
                ],
                [
                    'id_atasan' => $idAtasan,
                    'is_active' => true,
                    'tanggal_mulai' => now()->startOfDay(),
                    'tanggal_selesai' => null,
                ]
            );

            $selectedPairs[$this->pairKey($idPegawai, $categories[$categoryName])] = true;
        }

        $activeCategoryIds = array_values($categories);
        $existingApprovers = Approver::query()
            ->whereIn('id_approver_category', $activeCategoryIds)
            ->get(['id', 'id_pegawai', 'id_approver_category', 'is_active']);

        foreach ($existingApprovers as $existingApprover) {
            $pairKey = $this->pairKey((int) $existingApprover->id_pegawai, (int) $existingApprover->id_approver_category);
            if (isset($selectedPairs[$pairKey])) {
                continue;
            }

            if ((bool) $existingApprover->is_active) {
                $existingApprover->update([
                    'is_active' => false,
                    'tanggal_selesai' => now()->startOfDay(),
                ]);
            }
        }

        $missingCategories = array_diff(array_keys($categories), array_keys($selectedByCategory));
        if (!empty($missingCategories)) {
            $this->command?->warn('Kategori approver tanpa kandidat: '.implode(', ', $missingCategories));
        }
    }

    private function resolveSuperiorNid(string $positionId, array $nidByPosition): ?string
    {
        $positionId = strtoupper(trim($positionId));
        if ($positionId === '') {
            return null;
        }

        $fallbackMap = [
            'KS120007I' => 'KS120001I',
            'KS130002I' => 'KS130001I',
            'KS130001I' => 'KS000000I',
        ];

        $current = $positionId;
        $visited = [];

        while ($current !== '') {
            if (isset($nidByPosition[$current])) {
                return $nidByPosition[$current];
            }

            if (isset($visited[$current])) {
                return null;
            }
            $visited[$current] = true;

            $current = $fallbackMap[$current] ?? '';
        }

        return null;
    }

    private function resolveApproverCategory(array $row): ?string
    {
        $positionId = strtoupper(trim((string) ($row['POSITION_ID'] ?? '')));
        $jabatanLengkap = strtoupper($this->normalizeWhitespace((string) ($row['JABATAN_LENGKAP'] ?? '')));
        $ulpl = $this->normalizeUlpl((string) ($row['ULPL'] ?? ''));

        $positionMap = [
            'KS000000I' => 'Manager',
            'KS110001I' => 'Asman Operasi',
            'KS120001I' => 'Asman Pemeliharaan',
            'KS130001I' => 'Asman Enjiniring',
            'KS030009I' => 'Asman Business Support',
            'KS060001I' => 'Team Leader Lingkungan',
            'KS040001I' => 'Team Leader K3L',
            'KS110002I' => 'Team Leader Rendal OP',
            'KS110005I' => 'Team Leader Bahan Bakar',
            'KS010007I' => 'Team Leader Rendal HAR',
            'KS120004I' => 'Team Leader Outage',
            'KS120009I' => 'Team Leader Inventory dan Kontrol',
            'KS120007I' => 'Team Leader Inventory dan Kontrol',
            'KS130003I' => 'Team Leader System Owner',
            'KS130005I' => 'Team Leader CBM',
            'KS130008I' => 'Team Leader MMRK',
            'KS050001I' => 'Team Leader Pengadaan',
            'KS030011I' => 'Team Leader SDM',
            'KS030010I' => 'Team Leader Keuangan',
            'KS090001I' => 'Manager Ketapang',
            'KS100001I' => 'Manager Siantan',
            'KS080001I' => 'Manager Sei Raya',
            'KS070001I' => 'Manager Sanggau Sintang',
            'KS090015I' => 'TL Operasi - Ketapang',
            'KS090008I' => 'TL Pemeliharaan - Ketapang',
            'KS090018I' => 'TL K3L - Ketapang',
            'KS100015I' => 'TL Operasi - Siantan',
            'KS100008I' => 'TL Pemeliharaan - Siantan',
            'KS100018I' => 'TL K3L - Siantan',
            'KS080015I' => 'TL Operasi - Sei Raya',
            'KS080008I' => 'TL Pemeliharaan - Sei Raya',
            'KS080018I' => 'TL K3L - Sei Raya',
            'KS070021I' => 'TL Operasi - Sanggau Sintang',
            'KS070025I' => 'TL Pemeliharaan - Sanggau Sintang',
            'KS070018I' => 'TL K3L - Sanggau Sintang',
        ];

        if (isset($positionMap[$positionId])) {
            return $positionMap[$positionId];
        }

        if (str_contains($jabatanLengkap, 'MANAGER ENJINIRING & QA')) {
            return 'Asman Enjiniring';
        }

        if (str_contains($jabatanLengkap, 'TEAM LEADER KESELAMATAN')) {
            if ($ulpl === 'Ketapang') {
                return 'TL K3L - Ketapang';
            }
            if ($ulpl === 'Siantan') {
                return 'TL K3L - Siantan';
            }
            if ($ulpl === 'Sei Raya') {
                return 'TL K3L - Sei Raya';
            }
            if ($ulpl === 'Sanggau Sintang') {
                return 'TL K3L - Sanggau Sintang';
            }

            return 'Team Leader K3L';
        }

        return null;
    }

    private function approverParentMap(): array
    {
        return [
            'Asman Operasi' => 'Manager',
            'Asman Pemeliharaan' => 'Manager',
            'Asman Enjiniring' => 'Manager',
            'Asman Business Support' => 'Manager',
            'Team Leader Lingkungan' => 'Manager',
            'Team Leader K3L' => 'Manager',
            'Manager Ketapang' => 'Manager',
            'Manager Siantan' => 'Manager',
            'Manager Sei Raya' => 'Manager',
            'Manager Sanggau Sintang' => 'Manager',
            'Team Leader Rendal OP' => 'Asman Operasi',
            'Team Leader Bahan Bakar' => 'Asman Operasi',
            'Team Leader Rendal HAR' => 'Asman Pemeliharaan',
            'Team Leader Outage' => 'Asman Pemeliharaan',
            'Team Leader Inventory dan Kontrol' => 'Asman Pemeliharaan',
            'Team Leader System Owner' => 'Asman Enjiniring',
            'Team Leader CBM' => 'Asman Enjiniring',
            'Team Leader MMRK' => 'Asman Enjiniring',
            'Team Leader Pengadaan' => 'Asman Business Support',
            'Team Leader SDM' => 'Asman Business Support',
            'Team Leader Keuangan' => 'Asman Business Support',
            'TL Operasi - Ketapang' => 'Manager Ketapang',
            'TL Pemeliharaan - Ketapang' => 'Manager Ketapang',
            'TL K3L - Ketapang' => 'Manager Ketapang',
            'TL Operasi - Siantan' => 'Manager Siantan',
            'TL Pemeliharaan - Siantan' => 'Manager Siantan',
            'TL K3L - Siantan' => 'Manager Siantan',
            'TL Operasi - Sei Raya' => 'Manager Sei Raya',
            'TL Pemeliharaan - Sei Raya' => 'Manager Sei Raya',
            'TL K3L - Sei Raya' => 'Manager Sei Raya',
            'TL Operasi - Sanggau Sintang' => 'Manager Sanggau Sintang',
            'TL Pemeliharaan - Sanggau Sintang' => 'Manager Sanggau Sintang',
            'TL K3L - Sanggau Sintang' => 'Manager Sanggau Sintang',
        ];
    }

    private function mapJenisKelamin(string $jenisKelamin): string
    {
        $normalized = strtoupper(trim($jenisKelamin));
        return str_starts_with($normalized, 'P') ? 'P' : 'L';
    }

    private function parseDate(string $date): ?string
    {
        $date = trim($date);
        if ($date === '' || strlen($date) !== 8 || !ctype_digit($date)) {
            return null;
        }

        $year = substr($date, 0, 4);
        $month = substr($date, 4, 2);
        $day = substr($date, 6, 2);

        return checkdate((int) $month, (int) $day, (int) $year)
            ? $year.'-'.$month.'-'.$day
            : null;
    }

    private function pickUnitName(array $row): string
    {
        $ulpl = $this->normalizeWhitespace((string) ($row['ULPL'] ?? ''));
        if ($ulpl !== '') {
            return $ulpl;
        }

        return $this->normalizeWhitespace((string) ($row['LOKASI_UNIT'] ?? 'UPDK Kapuas'));
    }

    private function inferJenisUnit(string $unitName): string
    {
        $upperName = strtoupper($unitName);

        if (str_contains($upperName, 'ULPL')) {
            return 'ulpltd';
        }

        return 'up';
    }

    private function normalizeUlpl(string $value): string
    {
        $upper = strtoupper($this->normalizeWhitespace($value));
        if (str_contains($upper, 'KETAPANG')) {
            return 'Ketapang';
        }
        if (str_contains($upper, 'SIANTAN')) {
            return 'Siantan';
        }
        if (str_contains($upper, 'SEI RAYA')) {
            return 'Sei Raya';
        }
        if (str_contains($upper, 'SANGGAU') || str_contains($upper, 'SINTANG')) {
            return 'Sanggau Sintang';
        }

        return '';
    }

    private function normalizeWhitespace(string $value): string
    {
        return trim((string) preg_replace('/\s+/', ' ', $value));
    }

    private function pairKey(int $idPegawai, int $idCategory): string
    {
        return $idPegawai.':'.$idCategory;
    }
}
