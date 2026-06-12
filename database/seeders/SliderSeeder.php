<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'background_image' => 'frontend/images/slides/slider-mainbg-003.jpg',
            'front_image' => 'frontend/images/slides/slides-011.png',
            'subtitle' => 'Let your business to GROW',
            'title_1' => 'We Create Beautiful',
            'title_2' => '<strong class="ttm-textcolor-skincolor">Websites</strong>',
            'description' => 'Are you looking for the Best Web Application & eCommerce Website Design Company<br/> to develop your online store? Yes! you are in the right place! We are best for 100% secured.',
            'button_1_text' => 'Contact Us',
            'button_1_link' => 'contact-us',
            'button_2_text' => 'View More Details',
            'button_2_link' => 'responsive-web-design',
            'status' => true,
            'order' => 1,
        ]);

        Slider::create([
            'background_image' => 'frontend/images/slides/slider-mainbg-004.jpg',
            'front_image' => 'frontend/images/slides/slides-023.png',
            'subtitle' => 'Trust and Client Focus',
            'title_1' => 'Best<strong class="ttm-textcolor-skincolor"> Quality Web Application </strong>',
            'title_2' => 'For Your Business!',
            'description' => 'Are you looking for the Best Web Application & Website Design Company to develop<br/> your online application? Yes! you are in the right place! We are best for 100% secured.',
            'button_1_text' => 'Request a Quote',
            'button_1_link' => 'contact-us',
            'button_2_text' => 'Read More',
            'button_2_link' => 'web-development',
            'status' => true,
            'order' => 2,
        ]);

        Slider::create([
            'background_image' => 'frontend/images/slides/slider-mainbg-003.jpg',
            'front_image' => 'frontend/images/slides/slides-012.png',
            'subtitle' => 'Let your business to GROW',
            'title_1' => 'We Create Beautiful',
            'title_2' => '<strong class="ttm-textcolor-skincolor">eCommerce Websites</strong>',
            'description' => 'Are you looking for the Best eCommerce Website Design Company to develop your online store?<br/> Yes! you are in the right place! We are best for 100% secured.',
            'button_1_text' => 'Contact Us',
            'button_1_link' => 'contact-us',
            'button_2_text' => 'View More Details',
            'button_2_link' => 'wordpress-woocommerce',
            'status' => true,
            'order' => 3,
        ]);
    }
}
