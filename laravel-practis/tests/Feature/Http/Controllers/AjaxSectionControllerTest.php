<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AjaxSectionControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->company = Company::factory()->create();

        $this->section = Section::factory([
            'company_id' => $this->company->id,
        ])->create();

        $this->user = User::factory([
            'company_id' => $this->company->id,
        ])->create();

        $this->admin = User::factory([
            'company_id' => $this->company->id,
            'is_admin' => true,
        ])->create();
    }

    public function test_index()
    {
        $url = route('api.sections.index', ['company' => $this->company]);

        $response = $this->actingAs($this->user)->get($url);

        $response->assertStatus(200);
        $response->assertJson([$this->section->toArray()]);

        $response = $this->actingAs($this->admin)->get($url);

        $response->assertStatus(200);
        $response->assertJson([$this->section->toArray()]);
    }
}
