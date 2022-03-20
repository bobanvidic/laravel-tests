<?php
namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\PhoneNumber;
use App\Models\EmailAddress;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            $company = Company::factory()->create();
            Address::factory()->create([
                'addressable_type' => Company::class         ,
                'addressable_id'   => $company->id           ,
            ]);
            PhoneNumber::factory()->company()->create([
                'phonenumberable_id'    => $company->id            ,
                'phonenumberable_type'  => Company::class          ,

            ]);
            EmailAddress::factory()->company()->create([
                'emailaddressable_id'   => $company->id            ,
                'emailaddressable_type' => Company::class          ,
            ]);
        }
    }
}
