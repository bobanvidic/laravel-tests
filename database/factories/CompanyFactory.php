<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Country;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'country_id' => function() {
                return Country::inRandomOrder()->first();
            },
        ];
    }

    /**
     * @return CompanyFactory
     */
    public function withPhones()
    {
        return $this->afterCreating(function (Company $company) {
            $phone = PhoneNumber::factory()->create([
                'phonenumberable_type' => Company::class,
                'phonenumberable_id' => $company->id
            ]);
            $company->phones()->save($phone);
        });
    }

    /**
     * @return CompanyFactory
     */
    public function withEmails()
    {
        return $this->afterCreating(function (Company $company) {
            $email = EmailAddress::factory()->create([
                'emailaddressable_type' => Company::class,
                'emailaddressable_id' => $company->id
            ]);
            $company->emails()->save($email);
        });
    }
}
