<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        $user = User::factory()->create(
            [
                'name' => 'Jonhn Doe',
                'email' => 'john@gmail.com'
            ]
        );

        Material::factory(10)->create(['user_id' => $user->id]);

        


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //\App\Models\Material::factory(10)->create();
    }
}
