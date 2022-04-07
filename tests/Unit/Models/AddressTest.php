<?php

namespace Tests\Unit\Entities;

use App\Models\Address;
use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_address()
    {
        $address = Address::factory()->user()->create();
        $this->assertInstanceOf(User::class, $address->addressable);
    }

    /** @test */
    public function company_has_address()
    {
        $address = Address::factory()->company()->create();
        $this->assertInstanceOf(Company::class, $address->addressable);
    }
}
