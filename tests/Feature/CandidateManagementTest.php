<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidateManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_penerimaan_dashboard(): void
    {
        $response = $this->get('/penerimaan');

        $response->assertRedirect('/login');
    }

    public function test_admin_01_cannot_access_penerimaan_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'admin-01']);

        $response = $this->actingAs($user)->get('/penerimaan');

        $response->assertStatus(403);
    }

    public function test_admin_02_can_access_penerimaan_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'admin-02']);

        $response = $this->actingAs($user)->get('/penerimaan');

        $response->assertStatus(200);
    }

    public function test_admin_02_can_create_candidate(): void
    {
        $user = User::factory()->create(['role' => 'admin-02']);

        $response = $this->actingAs($user)->post('/penerimaan/calon', [
            'full_name' => 'Budi Sudarsono',
            'birth_place' => 'Jakarta',
            'birth_date' => '2009-04-12',
            'gender' => 'Laki-laki',
            'class_name' => 'X TKJ 2',
            'organization_type' => 'OSIS',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/penerimaan');
        $this->assertDatabaseHas('candidates', [
            'full_name' => 'Budi Sudarsono',
            'organization_type' => 'OSIS',
        ]);
    }

    public function test_admin_02_can_update_candidate_status(): void
    {
        $user = User::factory()->create(['role' => 'admin-02']);
        $candidate = Candidate::create([
            'registration_number' => 'OSKA-2026-9999',
            'full_name' => 'Siti Aminah',
            'birth_place' => 'Bekasi',
            'birth_date' => '2009-06-15',
            'gender' => 'Perempuan',
            'class_name' => 'X AKL 1',
            'organization_type' => 'OSIS',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->patch("/penerimaan/calon/{$candidate->id}/status", [
            'status' => 'passed',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('candidates', [
            'id' => $candidate->id,
            'status' => 'passed',
        ]);
    }

    public function test_public_can_check_snbp_selection_result(): void
    {
        \App\Models\Setting::set('announcement_status', 'published');

        $candidate = Candidate::create([
            'registration_number' => 'OSKA-2026-8888',
            'full_name' => 'Dewi Lestari',
            'birth_place' => 'Jakarta',
            'birth_date' => '2009-08-20',
            'gender' => 'Perempuan',
            'class_name' => 'X OTKP 1',
            'organization_type' => 'MPK',
            'status' => 'passed',
        ]);

        $response = $this->post('/pengumuman/cek', [
            'full_name' => 'Dewi Lestari',
            'birth_date' => '2009-08-20',
        ]);

        $response->assertStatus(200);
        $response->assertSee('SELAMAT! ANDA DINYATAKAN LOLOS SELEKSI');
        $response->assertSee('Dewi Lestari');
    }
}
