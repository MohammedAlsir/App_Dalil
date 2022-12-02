<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        $cities =
            [
                1 => [
                    [
                        'name_ar' => 'الخرطوم',
                        'name_en' => 'Khartoum'
                    ],
                    [
                        'name_ar' => 'أم درمان',
                        'name_en' => 'Omdrman',
                    ],
                    [
                        'name_ar' => 'بحري',
                        'name_en' => 'Bahry',
                    ],
                ],
                2 => [
                    [
                        'name_ar' => 'نهر عطبرة',
                        'name_en' => 'نهر عطبرة',
                    ],
                ]
            ];

        $index = 1;

        foreach ($cities as  $index => $single) {
            if ($index == 0)
                $index++;
            foreach ($single as  $item) {
                // State::create(['name' => $state]);
                $city = new City();
                $city->name_ar = $item['name_ar'];
                $city->name_en = $item['name_en'];
                $city->state_id = $index;

                $city->save();
            }
        }
    }
}