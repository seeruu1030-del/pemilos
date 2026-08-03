<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\CandidateMapping;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CandidateMappingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_02_can_access_osis_and_mpk_mapping_pages(): void
    {
        $admin = User::factory()->create(['role' => 'admin-02']);

        $responseOsis = $this->actingAs($admin)->get('/penerimaan/mapping/osis');
        $responseOsis->assertStatus(200);
        $responseOsis->assertSee('Mapping Pasangan Calon (Paslon) OSIS');

        $responseMpk = $this->actingAs($admin)->get('/penerimaan/mapping/mpk');
        $responseMpk->assertStatus(200);
        $responseMpk->assertSee('Mapping Pasangan Calon (Paslon) MPK');
    }

    public function test_admin_02_can_create_candidate_mapping(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin-02']);
        $chairman = Candidate::create([
            'registration_number' => 'OSKA-2026-0001',
            'full_name' => 'Ahmad Fauzi',
            'birth_place' => 'Jakarta',
            'birth_date' => '2009-05-14',
            'gender' => 'Laki-laki',
            'class_name' => 'X TKJ 1',
            'organization_type' => 'OSIS',
            'status' => 'passed',
        ]);

        $vice = Candidate::create([
            'registration_number' => 'OSKA-2026-0002',
            'full_name' => 'Siti Nurhaliza',
            'birth_place' => 'Bekasi',
            'birth_date' => '2009-08-22',
            'gender' => 'Perempuan',
            'class_name' => 'X AKL 2',
            'organization_type' => 'OSIS',
            'status' => 'passed',
        ]);

        $photo = UploadedFile::fake()->image('paslon1.jpg');

        $response = $this->actingAs($admin)->post('/penerimaan/mapping', [
            'organization_type' => 'OSIS',
            'paslon_number' => 1,
            'chairman_id' => $chairman->id,
            'vice_chairman_id' => $vice->id,
            'vision' => 'Mewujudkan OSIS yang unggul dan inovatif.',
            'mission' => '1. Meningkatkan kedisiplinan.\n2. Mengadakan event digital.',
            'photo' => $photo,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('candidate_mappings', [
            'organization_type' => 'OSIS',
            'paslon_number' => 1,
            'chairman_id' => $chairman->id,
            'vice_chairman_id' => $vice->id,
        ]);

        $mapping = CandidateMapping::first();
        $this->assertNotNull($mapping->photo);
        Storage::disk('public')->assertExists($mapping->photo);
    }

    public function test_admin_02_can_update_and_delete_mapping(): void
    {
        $admin = User::factory()->create(['role' => 'admin-02']);
        $mapping = CandidateMapping::create([
            'organization_type' => 'MPK',
            'paslon_number' => 1,
            'vision' => 'Visi awal MPK',
            'mission' => 'Misi awal MPK',
        ]);

        $updateResponse = $this->actingAs($admin)->post("/penerimaan/mapping/{$mapping->id}", [
            'paslon_number' => 1,
            'vision' => 'Visi MPK yang diperbarui',
            'mission' => 'Misi MPK yang diperbarui',
        ]);

        $updateResponse->assertRedirect();
        $this->assertDatabaseHas('candidate_mappings', [
            'id' => $mapping->id,
            'vision' => 'Visi MPK yang diperbarui',
        ]);

        $deleteResponse = $this->actingAs($admin)->delete("/penerimaan/mapping/{$mapping->id}");
        $deleteResponse->assertRedirect();
        $this->assertDatabaseMissing('candidate_mappings', [
            'id' => $mapping->id,
        ]);
    }
}
