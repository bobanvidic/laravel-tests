<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_address_index_page()
    {
        Address::factory()->company()->count(2)->create();
        Address::factory()->user()->count(2)->create();
        $response = $this->call('GET', '/addresses');

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
    }

    /** @test */
    public function a_user_can_get_address_edit_page()
    {
        $address = Address::factory()->company()->create();
        $response = $this->json('GET', "/addresses/{$address->id}/edit");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
    }

    /** @test */
    public function a_user_can_store_address()
    {
        $company = Company::factory()->create();
        $data = [
            'address' => 'Address Test',
            'addressable_type' => Company::class,
            'addressable_id' => $company->id,
        ];

        $response = $this->call('POST', "/addresses/store", $data);

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at storing address.');
        $this->assertDatabaseHas('addresses', [
           'address' => $data['address'],
        ]);
    }

    /** @test */
    public function a_user_can_not_store_address()
    {
        $company = Company::factory()->create();
        $data = [
            'address' => '',
            'addressable_type' => Company::class,
            'addressable_id' => $company->id,
        ];

        $response = $this->call('POST', "/addresses/store", $data);

        $response->assertSessionHasErrors([
            'address' => 'The address field is required.',
        ]);
        $this->assertEquals(Response::HTTP_FOUND, $response->status()  ,'Address is created without all data.');
    }

    /** @test */
    public function a_user_can_update_address()
    {
        $company = Company::factory()->create();
        $addrress = Address::factory()->company()->create();
        $data = [
            'address' => 'Test Address',
            'addressable_type' => Company::class,
            'addressable_id' => $company->id
        ];

        $response = $this->call('PUT', "/addresses/{$addrress->id}/update", $data);

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at updating address.');
        $this->assertDatabaseHas('addresses', [
           'address' => $data['address'],
        ]);
    }

    /** @test */
    public function a_user_can_delete_address()
    {
        $addrress = Address::factory()->company()->create();
        $response = $this->call('DELETE', "/addresses/{$addrress->id}/delete");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at deleting address.');
        $this->assertDatabaseMissing('addresses', [
            'id' => $addrress->id,
            'address' => $addrress->address
        ]);
    }
}
