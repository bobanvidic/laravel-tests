<?php

namespace Tests\Unit\Models;

use App\Models\Country;
use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Company
     *
     * @var Company $company
     */
    private $company;

    /**
     * Setup test environment for this test
     */
    public function setUp() :void
    {
        parent::setUp();
        Country::factory()->count(5)->create();
        $this->company = Company::factory()->withPhones()->withEmails()->create();
    }

    /** @test */
    public function company_has_phones()
    {
        $this->assertInstanceOf(Collection::class, $this->company->phones);
        $this->assertInstanceOf(PhoneNumber::class, $this->company->phones[0]);
    }

    /** @test */
    public function company_has_emails()
    {
        $this->assertInstanceOf(Collection::class, $this->company->emails);
        $this->assertInstanceOf(EmailAddress::class, $this->company->emails[0]);
    }

    /** @test */
    public function company_has_country()
    {
        $this->assertInstanceOf(Country::class, $this->company->country);
    }
}
