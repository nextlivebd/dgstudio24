<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeAboutSection;
use App\Models\HomeAboutFeature;

class HomeAboutSeeder extends Seeder
{
    public function run(): void
    {
        // ── About Section ────────────────────────────────────────────────────────
        HomeAboutSection::updateOrCreate(
            ['id' => 1],
            [
                'subtitle'    => 'About Global Graphic Giant',
                'title'       => 'Global Graphic Giant grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering client satisfaction.',
                'description' => 'Global Graphic Giant is one of the fastest growing and forward thinking IT solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Denmark, Norway, Germeny, Sweden), North America and Japan since 2006. We have a successful track record in serving our customers across the globe with vast experience in technical domain such as ASP .Net, C#, Java, PHP, iOS, Android. We have global presence in different time zones. We use latest technology and software for Web, e-commerce, Mobile Technology and Print Media.',
                'image'       => null, // Will use the existing frontend asset until uploaded
                'status'      => true,
            ]
        );

        $this->command->info('✅ Home About Section seeded.');

        // ── Feature Boxes ────────────────────────────────────────────────────────
        $features = [
            [
                'icon'        => 'ti ti-medall',
                'title'       => '100% Satisfaction',
                'description' => 'We are with you 24/7/365 to ensure your operations run smoothly.',
                'order'       => 1,
                'status'      => true,
            ],
            [
                'icon'        => 'ti ti-bookmark-alt',
                'title'       => 'Reduce Your Costs',
                'description' => 'In comparison to Western European and North American prices we can reduce your costs by 50%',
                'order'       => 2,
                'status'      => true,
            ],
        ];

        foreach ($features as $feature) {
            HomeAboutFeature::updateOrCreate(
                ['title' => $feature['title']],
                $feature
            );
        }

        $this->command->info('✅ Home About Features seeded (' . count($features) . ' items).');
    }
}
