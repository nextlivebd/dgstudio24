<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeDifferentSection;
use App\Models\HomeDifferentTab;

class HomeDifferentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Section Heading Settings
        HomeDifferentSection::updateOrCreate(
            ['id' => 1],
            [
                'subtitle'        => 'Why Are We Different From Others',
                'title'           => 'We are not like traditional outsourcing providers where they only focus on cost reduction. We focus on quality first followed by other aspects. We do not want to be a cheap provider rather than quality solution provider within',
                'title_highlight' => 'affordable cost.',
                'status'          => true,
            ]
        );

        // 2. Seed Tabs
        $tabs = [
            [
                'id'                  => 1,
                'title'               => 'Reduce your costs',
                'icon'                => 'flaticon-code',
                'content_title'       => 'Reduce your project costs',
                'content_description' => 'In comparison to Western European and North American prices we can reduce your costs by 50% when it comes to Web development, Mobile Application development, HTML5, Flash production & Graphics Design (Clipping Path, Image masking, Newspaper Ads design, Magazine makeup, Company branding etc.)',
                'order'               => 0,
                'status'              => true,
            ],
            [
                'id'                  => 2,
                'title'               => 'Simple Workflow',
                'icon'                => 'flaticon-report',
                'content_title'       => 'Our Process Workflow',
                'content_description' => 'We provide a well proven and efficient workflow. Just send the assignment through our FTP and get your finished materials back within few hours based on job complexity.',
                'order'               => 1,
                'status'              => true,
            ],
            [
                'id'                  => 3,
                'title'               => '24 Hour Service',
                'icon'                => 'flaticon-24h',
                'content_title'       => 'Our 24-hour service',
                'content_description' => 'We are with you 24/7/365 to ensure your operations run smoothly. We are committed to make sure that your business is always running-without interruption.',
                'order'               => 2,
                'status'              => true,
            ],
        ];

        foreach ($tabs as $tabData) {
            HomeDifferentTab::updateOrCreate(
                ['id' => $tabData['id']],
                $tabData
            );
        }
    }
}
