<?php
namespace Database\Seeders;

use App\Models\Address;
use App\Models\PhoneNumber;
use App\Models\EmailAddress;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            $user = User::factory()->create();
            Address::factory()->user()->create([
                'addressable_type' => User::class         ,
                'addressable_id'   => $user->id           ,
            ]);
            PhoneNumber::factory()->user()->create([
                'phonenumberable_id'   => $user->id            ,
                'phonenumberable_type' => User::class          ,

            ]);
            EmailAddress::factory()->user()->create([
                'emailaddressable_id'   => $user->id            ,
                'emailaddressable_type' => User::class          ,
            ]);
        }
    }
}
