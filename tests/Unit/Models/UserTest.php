<?php

namespace Tests\Unit\Entities;

use App\Models\Country;
use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test User
     *
     * @var User $user
     */
    private $user;

    /**
     * Setup test environment for this test
     */
    public function setUp() :void
    {
        parent::setUp();
        Country::factory()->count(5)->create();
        $this->user = User::factory()->withPhones()->withEmails()->create([
            'company_id' => Company::factory()->create()
        ]);
    }

    /** @test */
    public function user_has_phones()
    {
        $this->assertInstanceOf(Collection::class, $this->user->phones);
        $this->assertInstanceOf(PhoneNumber::class, $this->user->phones[0]);
    }

    /** @test */
    public function user_has_emails()
    {
        $this->assertInstanceOf(Collection::class, $this->user->emails);
        $this->assertInstanceOf(EmailAddress::class, $this->user->emails[0]);
    }

    /** @test */
    public function user_has_company()
    {
        $this->assertInstanceOf(Company::class, $this->user->company);
    }

    /** @test */
    public function get_full_name_of_user()
    {
        $this->assertIsString($this->user->full_name);
        $this->assertEquals($this->user->first_name, explode(' ', $this->user->full_name)[0]);
        $this->assertEquals($this->user->last_name, explode(' ', $this->user->full_name)[1]);
    }
}
