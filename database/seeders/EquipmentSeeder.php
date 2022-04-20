<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equipment_types')->insert(
            [
                [
                    'code' => 'test code 1',
                    'name' => 'TP-Link TL-WR74',
                    'mask' => 'XXAAAAAXAA',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'code' => 'test code 2',
                    'name' => 'D-Link DIR-300',
                    'mask' => 'NXXAAXZXaa',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'code' => 'test code 3',
                    'name' => 'D-Link DIR-300 S',
                    'mask' => 'NXXAAXZXXX',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ],
        );
        Equipment::factory()->count(50)->create();
    }
}
