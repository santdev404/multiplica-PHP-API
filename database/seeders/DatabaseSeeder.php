<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
use App\Models\User;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $pwd = hash('sha256', 'admin123');
        $userAdmin = User::create(['email' => 'admin@admin.com', 'password' => $pwd, 'role' => 'ROLE_ADMIN']);

        $Color1 = Color::create(['name' => 'Raspberry Sorbet', 'color' => '#D2386C', 'pantone' =>'17-3628', 'year'=>2021]);
        $Color2 = Color::create(['name' => 'Amethyst Orchid', 'color' => '#926AA6', 'pantone' =>'17-3628', 'year'=>2021]);
        $Color3 = Color::create(['name' => 'Mint', 'color' => '#00A170', 'pantone' =>'13-0117', 'year'=>2021]);
        $Color4 = Color::create(['name' => 'Burnt Coral', 'color' => '#E9897E', 'pantone' =>'16-1529', 'year'=>2021]);
        $Color5 = Color::create(['name' => 'Green Ash', 'color' => '#A0DAA9', 'pantone' =>'13-0117', 'year'=>2021]);
        $Color6 = Color::create(['name' => 'French Blue', 'color' => '#0072B5', 'pantone' =>'18-4140', 'year'=>2021]);

    }
}
