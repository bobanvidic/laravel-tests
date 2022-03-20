<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class PhoneNumberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_phone_list_page()
    {
        $phones = PhoneNumber::factory()->company()->count(2)->create();
        $response = $this->call('GET', '/phones');
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $response->assertJsonFragment(
            $phones[0]->only('phone')
        );
    }

    /** @test */
    public function a_user_can_see_phone_edit_page()
    {
        $phone = PhoneNumber::factory()->company()->create();
        $response = $this->json('GET', "/phones/{$phone->id}/edit");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $this->assertInstanceOf(Company::class, $phone->phonenumberable);
    }

    /** @test */
    public function a_user_can_store_phone()
    {
        $company = Company::factory()->create();
        $data = [
            'phone' => '011/123-1234',
            'phonenumberable_type' => Company::class,
            'phonenumberable_id' => $company->id,
        ];

        $response = $this->call('POST', "/phones/store", $data);
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at storing phone.');
        $this->assertDatabaseHas('phone_numbers', [
            'phone' => $data['phone'],
        ]);
    }

    /** @test */
    public function a_user_can_not_store_phone()
    {
        $company = Company::factory()->create();
        $data = [
            'phone' => '',
            'phonenumberable_type' => Company::class,
            'phonenumberable_id' => $company->id,
        ];

        $response = $this->call('POST', "/phones/store", $data);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field is required.',
        ]);
        $this->assertEquals(Response::HTTP_FOUND, $response->status()  ,'PhoneNumber is created without all necessary data.');
    }

    /** @test */
    public function a_user_can_update_phone()
    {
        $company = Company::factory()->create();
        $phone = PhoneNumber::factory()->user()->create();
        $data = [
            'id' => $phone->id,
            'phone' => '011/123-1234',
            'phonenumberable_type' => Company::class,
            'phonenumberable_id' => $company->id,
        ];

        $response = $this->call('PUT', "/phones/{$phone->id}/update", $data);
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at updating phone.');
        $this->assertDatabaseHas('phone_numbers', [
            'phone' => $data['phone'],
        ]);
    }

    /** @test */
    public function a_user_can_delete_phone()
    {
        $phoneNumber = PhoneNumber::factory()->company()->create();
        $response = $this->call('DELETE', "/phones/{$phoneNumber->id}/delete");

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at deleting phone.');
        $this->assertDatabaseMissing('phone_numbers', [
            'id' => $phoneNumber->id,
            'phone' => $phoneNumber->phone
        ]);
    }
}
