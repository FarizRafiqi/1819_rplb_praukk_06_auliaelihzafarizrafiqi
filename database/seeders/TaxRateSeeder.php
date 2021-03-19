<?php

namespace Database\Seeders;

use App\Models\TaxRate;
use Illuminate\Database\Seeder;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3171',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3172',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3173',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3174',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3175',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3201',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3271',
            'rate' => 3,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '5171',
            'rate' => 5,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3273',
            'rate' => 6,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '1275',
            'rate' => 7,
        ]);

        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3216',
            'rate' => 7,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3275',
            'rate' => 7,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3374',
            'rate' => 8,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '3515',
            'rate' => 8.5,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '1171',
            'rate' => 9,
        ]);
        
        TaxRate::create([
            'tax_type_id' => 1,
            'indonesia_city_id' => '7571',
            'rate' => 10,
        ]);
    }
}
