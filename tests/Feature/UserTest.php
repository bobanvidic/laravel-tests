<?php

namespace Tests\Feature;

use App\Mail\WelcomeMail;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_get_index_page()
    {
        $user = User::factory()->count(2)->create();
        $response = $this->call('GET', '/users');

        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $response->assertJsonFragment(
            $user[0]->only('first_name'),
            $user[0]->only('last_name'),
            $user[0]->only('email'),
            $user[0]->only('password'),
        );
    }

    /** @test */
    public function a_user_can_get_edit_page()
    {
        $user = User::factory()->create();
        $response = $this->json('GET', "/users/{$user->id}/edit");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'Show page is broken.');
        $this->assertInstanceOf(Company::class, $user->company);
    }

    /** @test */
    public function a_user_can_store_user()
    {
        $company = Company::factory()->create();
        $data = [
            'first_name' => 'Test',
            'last_name'  => 'Test',
            'email'      => 'test_testic@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company_id' => $company->id,
            'remember_token' => Str::random(10),
        ];

        $response = $this->call('POST', "/users/store", $data);
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at storing user.');
        $this->assertDatabaseHas('users', [
           'first_name' => $data['first_name'],
           'last_name' => $data['last_name'],
           'email' => $data['email'],
        ]);
    }

    /** @test */
    public function a_user_can_not_store_user()
    {
        $company = Company::factory()->create();
        $data = [
            'first_name' => '',
            'last_name'  => '',
            'email'      => 'test_testic@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'company_id' => $company->id,
            'remember_token' => Str::random(10),
        ];

        $response = $this->call('POST', "/users/store", $data);

        $response->assertSessionHasErrors([
            'first_name' => 'The first name field is required.',
            'last_name' => 'The last name field is required.'
        ]);
        $this->assertEquals(Response::HTTP_FOUND, $response->status()  ,'User is created without all data.');
    }

    /** @test */
    public function a_user_can_update_user()
    {
        $user = User::factory()->create();
        $data = [
            'first_name' => 'Test',
            'last_name'  => 'Test',
            'email'      => 'test_testic@gmail.com',
            'email_verified_at' => now(),
            'password' => $user->password,
            'company_id' => $user->company->id,
            'remember_token' => $user->remember_token,
        ];

        $response = $this->call('PUT', "/users/{$user->id}/update", $data);
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at updating user.');
        $this->assertDatabaseHas('users', [
           'first_name' => $data['first_name'],
           'last_name' => $data['last_name'],
           'email' => $data['email'],
        ]);
    }

    /** @test */
    public function a_user_can_delete_user()
    {
        $user = User::factory()->create();
        $response = $this->call('DELETE', "/users/{$user->id}/delete");
        $this->assertEquals(Response::HTTP_OK, $response->status()  ,'There was error at deleting user.');
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'first_name' => $user->first_name
        ]);
    }

    /** @test */
    public function a_user_send_welcome_email()
    {
        Mail::fake();

        $this->call('GET', "/users/send-email");

        Mail::assertSent(WelcomeMail::class);
    }
}
