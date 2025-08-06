<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'الرياض' => ['حي العليا', 'حي الملز', 'حي النسيم', 'حي السليمانية'],
            'جدة' => ['حي البلد', 'حي الحمراء', 'حي أبحر', 'حي السلامة'],
            'الدمام' => ['حي الفيصلية', 'حي الشاطئ', 'حي عبد الله فؤاد', 'حي أحد'],
        ];

        foreach ($data as $cityName => $districts) {
            $city = City::where('name', $cityName)->first();
            if ($city) {
                foreach ($districts as $districtName) {
                    District::create([
                        'city_id' => $city->id,
                        'name' => $districtName,
                    ]);
                }
            }
        }
    }
}