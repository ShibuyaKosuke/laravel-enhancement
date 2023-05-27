<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
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
        $response = $this->actingAs($this->user)->get(route('users.index'));

        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get(route('users.index', ['company_id' => 1]));

        $response->assertStatus(200);

        $response = $this->actingAs($this->user)->get(route('users.index', ['company_id' => 1, 'section_id' => 2]));

        $response->assertStatus(200);
    }
}
