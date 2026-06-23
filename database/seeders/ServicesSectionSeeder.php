<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServicesSectionSetting;

class ServicesSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicesSectionSetting::updateOrCreate(
            ['id' => 1],
            [
                'subtitle'        => 'Our Services',
                'title'           => 'We run all kinds of Web Development, Image Design & 3D services with 19+ years of',
                'title_highlight' => 'experience',
                'status'          => true,
            ]
        );
    }
}
