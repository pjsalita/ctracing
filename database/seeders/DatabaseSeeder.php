<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@arguide.app',
            'password' => \Hash::make('s3cure'),
            'email_verified_at' => now(),
        ]);
    }
}
