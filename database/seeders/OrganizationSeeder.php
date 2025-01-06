<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $buildings = Building::all();
        $foodActivities = Activity::where('name', 'like', '%продукция')->get();
        $autoActivities = Activity::where('parent_id', Activity::where('name', 'Автомобили')->first()->id)->get();

        // Создаем организации
        $organization1 = Organization::create([
            'name' => 'ООО "Рога и Копыта"',
            'building_id' => $buildings->random()->id,
        ]);

        // Добавляем телефоны
        Phone::create(['number' => '2-222-222', 'organization_id' => $organization1->id]);
        Phone::create(['number' => '3-333-333', 'organization_id' => $organization1->id]);

        // Привязываем виды деятельности
        $organization1->activities()->attach($foodActivities->random(2));

        $organization2 = Organization::create([
            'name' => 'АвтоМир',
            'building_id' => $buildings->random()->id,
        ]);

        Phone::create(['number' => '8-923-666-13-13', 'organization_id' => $organization2->id]);
        $organization2->activities()->attach($autoActivities->random(2));

        $organization3 = Organization::create([
            'name' => 'Молочный Дом',
            'building_id' => $buildings->random()->id,
        ]);

        Phone::create(['number' => '4-444-444', 'organization_id' => $organization3->id]);
        $organization3->activities()->attach(Activity::where('name', 'Молочная продукция')->first()->id);
    }
}
