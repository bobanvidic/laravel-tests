<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $company = Company::first();
        if (! $company) {
            $company = Company::factory()->create();
        }
        return [
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now()  ,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'company_id'        => $company->id,
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function withCompany(): UserFactory
    {
        return $this->afterCreating(function (User $user) {
            $company = Company::factory()->create();
            $user->company_id = $company->id;
            $user->save();
        });
    }

    /**
     * @return UserFactory
     */
    public function withPhones()
    {
        return $this->afterCreating(function (User $user) {
            $phone = PhoneNumber::factory()->create([
                'phonenumberable_type' => User::class,
                'phonenumberable_id' => $user->id
            ]);
            $user->phones()->save($phone);
        });
    }

    /**
     * @return UserFactory
     */
    public function withEmails()
    {
        return $this->afterCreating(function (User $user) {
            $email = EmailAddress::factory()->create([
                'emailaddressable_type' => User::class,
                'emailaddressable_id' => $user->id
            ]);
            $user->emails()->save($email);
        });
    }
}
