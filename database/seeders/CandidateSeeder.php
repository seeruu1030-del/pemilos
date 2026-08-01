<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleCandidates = [
            [
                'registration_number' => 'OSIS-2026-0001',
                'full_name' => 'Ahmad Fauzi',
                'birth_place' => 'Jakarta',
                'birth_date' => '2009-05-14',
                'gender' => 'Laki-laki',
                'class_name' => 'X TKJ 1',
                'organization_type' => 'OSIS',
                'status' => 'passed',
                'notes' => 'Lolos wawancara dan tes kepemimpinan dengan nilai sangat baik.',
            ],
            [
                'registration_number' => 'OSIS-2026-0002',
                'full_name' => 'Siti Nurhaliza',
                'birth_place' => 'Bekasi',
                'birth_date' => '2009-08-22',
                'gender' => 'Perempuan',
                'class_name' => 'X AKL 2',
                'organization_type' => 'OSIS',
                'status' => 'passed',
                'notes' => 'Diterima sebagai Calon Pengurus OSIS Divisi Kerohanian.',
            ],
            [
                'registration_number' => 'MPK-2026-0003',
                'full_name' => 'Budi Santoso',
                'birth_place' => 'Depok',
                'birth_date' => '2009-03-10',
                'gender' => 'Laki-laki',
                'class_name' => 'X RPL 1',
                'organization_type' => 'MPK',
                'status' => 'passed',
                'notes' => 'Lolos seleksi MPK Komisi A (Legislasi).',
            ],
            [
                'registration_number' => 'OSIS-2026-0004',
                'full_name' => 'Rizky Pratama',
                'birth_place' => 'Tangerang',
                'birth_date' => '2009-05-11',
                'gender' => 'Laki-laki',
                'class_name' => 'X TKR 1',
                'organization_type' => 'OSIS',
                'status' => 'failed',
                'notes' => 'Belum memenuhi kualifikasi kehadiran wawancara.',
            ],
            [
                'registration_number' => 'MPK-2026-0005',
                'full_name' => 'Anisa Rahmawati',
                'birth_place' => 'Jakarta',
                'birth_date' => '2009-07-19',
                'gender' => 'Perempuan',
                'class_name' => 'X OTKP 1',
                'organization_type' => 'MPK',
                'status' => 'pending',
                'notes' => 'Menunggu pelaksanaan wawancara tahap 2.',
            ],
        ];

        foreach ($sampleCandidates as $candidate) {
            Candidate::updateOrCreate(
                ['registration_number' => $candidate['registration_number']],
                $candidate
            );
        }
    }
}
