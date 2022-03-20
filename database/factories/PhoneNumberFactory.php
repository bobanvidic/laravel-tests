<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneNumber>
 */
class PhoneNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber  ,
        ];
    }

    /**
     * @return PhoneNumberFactory
     */
    public function user()
    {
        return $this->state(function () {
            return [
                'phonenumberable_type' => User::class,
                'phonenumberable_id' => function () {
                    return User::factory()->create()->id;
                },
            ];
        });
    }

    /**
     * @return PhoneNumberFactory
     */
    public function company()
    {
        return $this->state(function () {
            return [
                'phonenumberable_type' => Company::class,
                'phonenumberable_id' => function () {
                    return Company::factory()->create()->id;
                },
            ];
        });
    }
}
