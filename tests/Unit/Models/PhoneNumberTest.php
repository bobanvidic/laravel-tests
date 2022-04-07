<?php

namespace Tests\Unit\Entities;

use App\Models\Company;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneNumberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_phone()
    {
        $phone = PhoneNumber::factory()->user()->create();
        $this->assertInstanceOf(User::class, $phone->phonenumberable);
    }

    /** @test */
    public function company_has_phone()
    {
        $phone = PhoneNumber::factory()->company()->create();
        $this->assertInstanceOf(Company::class, $phone->phonenumberable);
    }
}
