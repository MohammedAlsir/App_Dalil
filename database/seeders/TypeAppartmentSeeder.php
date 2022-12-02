<?php

namespace Database\Seeders;

use App\Models\TypeAppartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAppartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel_appartments')->delete();

        $types =
            [
                [
                    'name_ar' => 'غرفة فردية',
                    'name_en' => 'Single Room'
                ],
                [
                    'name_ar' => 'غرفة مزدوجة',
                    'name_en' => 'Double Room',
                ],
                [
                    'name_ar' => 'غرفة ثنائبة',
                    'name_en' => 'Twin Room',
                ],
                [
                    'name_ar' => 'غرفة ثلاثية',
                    'name_en' => 'Triple Room',
                ],
                [
                    'name_ar' => 'غرفة رباعية',
                    'name_en' => 'Quardruple Room',
                ],
                [
                    'name_ar' => 'غرفة مزدوجة - مزدوجة',
                    'name_en' => 'Double-Double Room',
                ],
                [
                    'name_ar' => 'غرفة كلاسيكية',
                    'name_en' => 'Classic Room',
                ],
                [
                    'name_ar' => 'غرفة فاخرة',
                    'name_en' => 'Superior Room',
                ],
                [
                    'name_ar' => 'غرفة ديلوكس',
                    'name_en' => 'Deluxe Room',
                ],
                [
                    'name_ar' => 'جناح عادي',
                    'name_en' => 'Suite',
                ],
                [
                    'name_ar' => 'جناح تنفيذي',
                    'name_en' => 'Executive Suite',
                ],
                [
                    'name_ar' => 'جناح رئاسي',
                    'name_en' => 'Presidential Suite',
                ],
                [
                    'name_ar' => 'جناح ملكي',
                    'name_en' => 'Royal Suite',
                ],
            ];

        foreach ($types as  $single) {
            $type = new TypeAppartment();
            $type->name_ar = $single['name_ar'];
            $type->name_en = $single['name_en'];
            $type->save();
        }
    }
}