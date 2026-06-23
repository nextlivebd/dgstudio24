<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeVideoBanner;

class HomeVideoBannerSeeder extends Seeder
{
    public function run(): void
    {
        HomeVideoBanner::updateOrCreate(
            ['id' => 1],
            [
                'title'            => 'We help to create your business identity &',
                'title_highlight'  => 'stunning on online,',
                'description'      => 'with Basic Website, Web Application, CMS Web Development, Dynamic Website to Advanced Level of Ecommerce Development.',
                'btn_text'         => 'View Portfolio',
                'btn_url'          => 'portfolio',
                'video_url'        => 'https://www.youtube.com/embed/9fidoaaOn_4',
                'background_image' => null,
                'logo_source'      => 'site_logo',
                'custom_logo'      => null,
                'status'           => true,
            ]
        );
    }
}
