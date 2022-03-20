<?php

namespace Tests\Unit\Entities;

use App\Models\Company;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function country_has_companies()
    {
        $country = Country::factory()->create();
        for ($i = 0; $i < 2; $i ++) {
            Company::factory()->create([
                'country_id' => $country->id
            ]);
        }

        $this->assertNotNull($country->companies);
        $this->assertInstanceOf(Collection::class, $country->companies);
        $this->assertEquals(2, $country->companies->count());
        $this->assertInstanceOf(Company::class, $country->companies[0]);
    }
}
