<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EmailAddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_email_list_page()
    {
        $emails = EmailAddress::factory()->company()->count(2)->create();
        $response = $this->call('GET', '/emails');
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $response->assertJsonFragment(
            $emails[0]->only('email')
        );
    }

    /** @test */
    public function a_user_can_see_email_edit_page()
    {
        $email = EmailAddress::factory()->company()->create();
        $response = $this->json('GET', "/emails/{$email->id}/edit");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $this->assertInstanceOf(Company::class, $email->emailaddressable);
    }

    /** @test */
    public function a_user_can_store_email()
    {
        $company = Company::factory()->create();
        $data = [
            'email' => 'test@gmail.com',
            'emailaddressable_type' => Company::class,
            'emailaddressable_id' => $company->id,
        ];

        $response = $this->call('POST', "/emails/store", $data);

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at storing phone.');
        $this->assertDatabaseHas('email_addresses', [
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function a_user_can_not_store_phone()
    {
        $company = Company::factory()->create();
        $data = [
            'email' => '',
            'emailaddressable_type' => Company::class,
            'emailaddressable_id' => $company->id,
        ];

        $response = $this->call('POST', "/emails/store", $data);

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
        $this->assertEquals(Response::HTTP_FOUND, $response->status()  ,'Email Address is created without all necessary data.');
    }

    /** @test */
    public function a_user_can_update_email()
    {
        $company = Company::factory()->create();
        $email = EmailAddress::factory()->user()->create();
        $data = [
            'id' => $email->id,
            'email' => 'test@gmail.com',
            'emailaddressable_type' => Company::class,
            'emailaddressable_id' => $company->id,
        ];

        $response = $this->call('PUT', "/emails/{$email->id}/update", $data);
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at updating email.');
        $this->assertDatabaseHas('email_addresses', [
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function a_user_can_delete_email()
    {
        $emailAddress = EmailAddress::factory()->company()->create();
        $response = $this->call('DELETE', "/emails/{$emailAddress->id}/delete");

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at deleting email.');
        $this->assertDatabaseMissing('email_addresses', [
            'id' => $emailAddress->id,
            'email' => $emailAddress->email
        ]);
    }
}
