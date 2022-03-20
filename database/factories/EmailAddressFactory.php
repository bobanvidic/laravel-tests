<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailAddress>
 */
class EmailAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->safeEmail  ,
        ];
    }


    /**
     * @return EmailAddressFactory
     */
    public function user()
    {
        return $this->state(function () {
            return [
                'emailaddressable_type' => User::class,
                'emailaddressable_id' => function () {
                    return User::factory()->create()->id;
                },
            ];
        });
    }

    /**
     * @return EmailAddressFactory
     */
    public function company()
    {
        return $this->state(function () {
            return [
                'emailaddressable_type' => Company::class,
                'emailaddressable_id' => function () {
                    return Company::factory()->create()->id;
                },
            ];
        });
    }
}
