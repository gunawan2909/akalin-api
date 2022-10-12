<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => bcrypt('1234'),
            'university' => 'Diponegoro',
            'phone' => '0857417182000',
            'study_program' => 'Teknik Komputer',
            'avatar' => 'https://png.pngtree.com/png-vector/20190710/ourlarge/pngtree-user-vector-avatar-png-image_1541962.jpg',
            'point' => 0,
            'access' => 'admin',
        ]);
    }
}
