<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_company_index_page()
    {
        $companies = Company::factory()->count(2)->create();
        $response = $this->call('GET', '/companies');

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $response->assertJsonFragment(
            $companies[0]->only('name')
        );
    }

    /** @test */
    public function a_user_can_get_company_edit_page()
    {
        $company = Company::factory()->create();
        $response = $this->json('GET', "/companies/{$company->id}/edit");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
    }

    /** @test */
    public function a_user_can_store_company()
    {
        $country = Country::factory()->create();
        $data = [
            'name' => 'Company Test',
            'country_id' => $country->id,
        ];

        $response = $this->call('POST', "/companies/store", $data);

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at storing company.');
        $this->assertDatabaseHas('companies', [
           'name' => $data['name'],
        ]);
    }

    /** @test */
    public function a_user_can_not_store_company()
    {
        $company = Company::factory()->create();
        $data = [
            'first_name' => '',
            'country_id' => $company->id,
        ];

        $response = $this->call('POST', "/companies/store", $data);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
        ]);
        $this->assertEquals(Response::HTTP_FOUND, $response->status()  ,'Company is created without all data.');
    }

    /** @test */
    public function a_user_can_update_company()
    {
        $company = Company::factory()->create();
        $country = Country::factory()->create();
        $data = [
            'name' => $company->name,
            'country_id'  => $country->id,
        ];

        $response = $this->call('PUT', "/companies/{$company->id}/update", $data);

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at updating company.');
        $this->assertDatabaseHas('companies', [
           'name' => $data['name'],
        ]);
    }

    /** @test */
    public function a_user_can_delete_company()
    {
        $company = Company::factory()->create();
        $response = $this->call('DELETE', "/companies/{$company->id}/delete");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at deleting company.');
        $this->assertDatabaseMissing('companies', [
            'id' => $company->id,
            'name' => $company->name
        ]);
    }
}
