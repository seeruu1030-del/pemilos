<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'admin01'],
            [
                'name' => 'Admin Pemilos',
                'email' => 'admin01@oska.sch.id',
                'password' => 'password',
                'role' => 'admin-01',
            ]
        );

        User::firstOrCreate(
            ['username' => 'admin02'],
            [
                'name' => 'Admin Penerimaan',
                'email' => 'admin02@oska.sch.id',
                'password' => 'password',
                'role' => 'admin-02',
            ]
        );

        User::firstOrCreate(
            ['username' => 'admin03'],
            [
                'name' => 'Admin Pemilos MPK',
                'email' => 'admin03@oska.sch.id',
                'password' => 'password',
                'role' => 'admin-03',
            ]
        );

        $this->call([
            CandidateSeeder::class,
            MpkCandidateSeeder::class,
        ]);
    }
}
