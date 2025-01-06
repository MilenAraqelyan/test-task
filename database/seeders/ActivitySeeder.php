<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Создаем корневые категории (уровень 1)
        $food = Activity::create([
            'name' => 'Еда',
            'level' => 1,
        ]);

        $auto = Activity::create([
            'name' => 'Автомобили',
            'level' => 1,
        ]);

        // Создаем подкатегории для "Еда" (уровень 2)
        $meatProducts = Activity::create([
            'name' => 'Мясная продукция',
            'parent_id' => $food->id,
            'level' => 2,
        ]);

        $dairyProducts = Activity::create([
            'name' => 'Молочная продукция',
            'parent_id' => $food->id,
            'level' => 2,
        ]);

        // Создаем подкатегории для "Автомобили" (уровень 2)
        $trucks = Activity::create([
            'name' => 'Грузовые',
            'parent_id' => $auto->id,
            'level' => 2,
        ]);

        $cars = Activity::create([
            'name' => 'Легковые',
            'parent_id' => $auto->id,
            'level' => 2,
        ]);

        // Создаем подкатегории третьего уровня
        Activity::create([
            'name' => 'Запчасти',
            'parent_id' => $cars->id,
            'level' => 3,
        ]);

        Activity::create([
            'name' => 'Аксессуары',
            'parent_id' => $cars->id,
            'level' => 3,
        ]);
    }
}
