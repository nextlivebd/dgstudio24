<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Smart create user (prevents 1062 duplicate error)
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Run other seeders automatically
        $this->call([
            SectionSettingsSeeder::class,
            SliderSeeder::class,
            ShehalaServiceSeeder::class,
            ShehalaPortfolioSeeder::class,
        ]);
    }
}