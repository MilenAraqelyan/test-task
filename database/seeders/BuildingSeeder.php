<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $buildings = [
            [
                'address' => 'г. Москва, ул. Ленина 1, офис 3',
                'latitude' => 55.7558,
                'longitude' => 37.6173,
            ],
            [
                'address' => 'г. Москва, ул. Блюхера, 32/1',
                'latitude' => 55.7539,
                'longitude' => 37.6208,
            ],
            [
                'address' => 'г. Москва, пр. Мира, 119',
                'latitude' => 55.7529,
                'longitude' => 37.6330,
            ],
        ];

        foreach ($buildings as $building) {
            Building::create($building);
        }
    }
}
