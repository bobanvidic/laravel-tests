<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address()  ,
        ];
    }

    /**
     * @return AddressFactory
     */
    public function user()
    {
        return $this->state(function(){
            return [
                'addressable_type' => User::class,
                'addressable_id' => function () {
                    return User::factory()->create()->id;
                },
            ];
        });
    }

    /**
     * @return AddressFactory
     */
    public function company()
    {
        return $this->state(function(){
            return [
                'addressable_type' => Company::class,
                'addressable_id' => function () {
                    return Company::factory()->create()->id;
                },
            ];
        });
    }
}
