<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CandidateMapping;
use Illuminate\Database\Seeder;

class MpkCandidateSeeder extends Seeder
{
    public function run(): void
    {
        $c1 = Candidate::updateOrCreate(
            ['registration_number' => 'OSKA-2026-0003'],
            [
                'full_name' => 'Budi Santoso',
                'birth_place' => 'Depok',
                'birth_date' => '2009-03-10',
                'gender' => 'Laki-laki',
                'class_name' => 'X RPL 1',
                'organization_type' => 'MPK',
                'status' => 'passed',
                'notes' => 'Lolos seleksi MPK Komisi A (Legislasi).',
            ]
        );

        $c2 = Candidate::updateOrCreate(
            ['registration_number' => 'OSKA-2026-0005'],
            [
                'full_name' => 'Anisa Rahmawati',
                'birth_place' => 'Jakarta',
                'birth_date' => '2009-07-19',
                'gender' => 'Perempuan',
                'class_name' => 'X OTKP 1',
                'organization_type' => 'MPK',
                'status' => 'passed',
                'notes' => 'Lolos seleksi MPK Komisi B (Pengawasan).',
            ]
        );

        $c3 = Candidate::updateOrCreate(
            ['registration_number' => 'OSKA-2026-0006'],
            [
                'full_name' => 'Fadhil Muhammad',
                'birth_place' => 'Bekasi',
                'birth_date' => '2009-02-15',
                'gender' => 'Laki-laki',
                'class_name' => 'X TKJ 2',
                'organization_type' => 'MPK',
                'status' => 'passed',
                'notes' => 'Lolos seleksi MPK Komisi C (Aspirasi).',
            ]
        );

        $c4 = Candidate::updateOrCreate(
            ['registration_number' => 'OSKA-2026-0007'],
            [
                'full_name' => 'Nabila Putri',
                'birth_place' => 'Tangerang',
                'birth_date' => '2009-11-08',
                'gender' => 'Perempuan',
                'class_name' => 'X AKL 1',
                'organization_type' => 'MPK',
                'status' => 'passed',
                'notes' => 'Lolos seleksi MPK Komisi D (Anggaran).',
            ]
        );

        CandidateMapping::updateOrCreate(
            ['organization_type' => 'MPK', 'paslon_number' => 1],
            [
                'chairman_id' => $c1->id,
                'vice_chairman_id' => $c2->id,
                'vision' => 'Mewujudkan MPK SMKS Nurul Islam yang kritis, transparan, dan proaktif dalam mengawasi serta menyalurkan aspirasi seluruh siswa.',
                'mission' => "1. Meningkatkan efektivitas komisi legislasi & pengawasan program OSIS.\n2. Membuka layanan aduan dan aspirasi digital siswa SMKS Nurul Islam secara realtime.",
            ]
        );

        CandidateMapping::updateOrCreate(
            ['organization_type' => 'MPK', 'paslon_number' => 2],
            [
                'chairman_id' => $c3->id,
                'vice_chairman_id' => $c4->id,
                'vision' => 'Mengoptimalkan peran perwakilan kelas yang aspiratif, berintegritas, dan inovatif di SMKS Nurul Islam.',
                'mission' => "1. Mendorong sinergi harmonis antara MPK, OSIS, dan pihak sekolah.\n2. Mengadakan forum musyawarah perwakilan kelas berkala yang inklusif.",
            ]
        );
    }
}
