<?php

namespace Tests\Unit\Entities;

use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailAddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_email()
    {
        $email = EmailAddress::factory()->user()->create();
        $this->assertInstanceOf(User::class, $email->emailaddressable);
    }

    /** @test */
    public function company_has_email()
    {
        $email = EmailAddress::factory()->company()->create();
        $this->assertInstanceOf(Company::class, $email->emailaddressable);
    }
}
