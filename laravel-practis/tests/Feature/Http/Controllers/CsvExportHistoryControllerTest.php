<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\CsvExportHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CsvExportHistoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->company = Company::factory()->create();
        $this->user = User::factory([
            'company_id' => $this->company->id,
        ])->create();

        $this->admin = User::factory([
            'company_id' => $this->company->id,
            'is_admin' => true,
        ])->create();
    }

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->actingAs($this->user)->get('/csv-export-histories');

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->actingAs($this->user)->get(route('download.users'));

        $response->assertStatus(200);
        $response->assertDownload();

        $csvExportHistory = CsvExportHistory::query()->with(['exportedBy'])->latest()->first();

        $response = $this->actingAs($this->user)->get(route('csv-export-histories.show', ['csv_export_history' => $csvExportHistory]));

        $response->assertStatus(200);
    }
}
