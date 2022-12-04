<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();

        $states =
            [
                [
                    'name_ar' => 'الخرطوم',
                    'name_en' => 'Khartoum'
                ],
                [
                    'name_ar' => 'كسلا',
                    'name_en' => 'Kasala',
                ],
            ];

        foreach ($states as  $single) {
            // State::create(['name' => $state]);
            $state = new State();
            $state->name_ar = $single['name_ar'];
            $state->name_en = $single['name_en'];
            $state->save();
        }
    }
}