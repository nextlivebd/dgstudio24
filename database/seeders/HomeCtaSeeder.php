<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeCtaSection;

class HomeCtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeCtaSection::updateOrCreate(
            ['id' => 1],
            [
                'title'       => 'Knock Us if you need to create an awesome website & web application!',
                'description' => 'Global Graphic Giant is one of the fastest growing and forward thinking IT solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Denmark, Norway, Germeny, Sweden), North America and Japan since 2006.',
                'image'       => 'frontend/images/bg-image/Save_money.png',
                'status'      => true,
            ]
        );
    }
}
