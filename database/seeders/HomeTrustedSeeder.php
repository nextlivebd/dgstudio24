<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeTrustedSection;
use App\Models\HomeTrustedFeature;
use App\Models\HomeTrustedCounter;

class HomeTrustedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeTrustedSection::updateOrCreate(
            ['id' => 1],
            [
                'subtitle'        => 'About Global Graphic Giant',
                'title'           => 'Trusted by 5,000+',
                'title_highlight' => 'Happy Clients',
                'description'     => 'Global Graphic Giant grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering client satisfaction.',
                'status'          => true,
            ]
        );

        // Features
        $features = [
            [
                'icon'  => 'flaticon flaticon-24h',
                'title' => '100% Satisfaction',
                'order' => 1,
            ],
            [
                'icon'  => 'flaticon flaticon-code',
                'title' => 'World Class Developer',
                'order' => 2,
            ],
            [
                'icon'  => 'flaticon flaticon-data',
                'title' => 'World Class Designer & 3D Artist',
                'order' => 3,
            ],
        ];

        foreach ($features as $f) {
            HomeTrustedFeature::updateOrCreate(
                ['title' => $f['title']],
                [
                    'icon'   => $f['icon'],
                    'order'  => $f['order'],
                    'status' => true,
                ]
            );
        }

        // Counters
        $counters = [
            [
                'icon'  => 'flaticon flaticon-developer',
                'count' => 14,
                'label' => 'Markets',
                'order' => 1,
            ],
            [
                'icon'  => 'flaticon flaticon-developer',
                'count' => 90,
                'label' => 'FTE',
                'order' => 2,
            ],
            [
                'icon'  => 'flaticon flaticon-interaction',
                'count' => 13214,
                'label' => 'Jobs Completed',
                'order' => 3,
            ],
            [
                'icon'  => 'flaticon flaticon-global-1',
                'count' => 323510,
                'label' => 'Deliverables',
                'order' => 4,
            ],
        ];

        foreach ($counters as $c) {
            HomeTrustedCounter::updateOrCreate(
                ['label' => $c['label']],
                [
                    'icon'   => $c['icon'],
                    'count'  => $c['count'],
                    'order'  => $c['order'],
                    'status' => true,
                ]
            );
        }
    }
}
