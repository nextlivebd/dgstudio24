<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestimonialSection;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestimonialSection::updateOrCreate(
            ['id' => 1],
            [
                'subtitle'          => 'About us',
                'title'             => 'We deal with the aspects of professional',
                'title_highlight'   => 'Web Services',
                'cta_text'          => 'Need a service & ready to order? Call us',
                'cta_phone'         => '+1 (416) 686-3111',
                'right_image'       => null,
                'experience_count'  => 19,
                'experience_label'  => 'Years of Experience Web Solution',
                'status'            => true,
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Eddle Cipolla'],
            [
                'position' => 'Account Director at St. Joseph Communications, Canada',
                'rating'   => 5,
                'avatar'   => null,
                'quote'    => 'I am working with Global Graphic Giant for the past 5 years. I find Global Graphic Giant is very professional and always putting the needs of their customers first. You can always be assured the work produced by Global Graphic Giant is top quality on all levels. Always a pleasure working with Shehala.',
                'order'    => 1,
                'status'   => true,
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Chris Mikkelsen'],
            [
                'position' => 'Production Chief at enVision',
                'rating'   => 5,
                'avatar'   => null,
                'quote'    => "I have worked with many different outsourcing companies (suppliers of different products), Global Graphic Giant is without doubt, one of the best companies. They work fast, good and for a fair price. They are not the cheapest but, you can't get better quality cheaper. Quality and price go hand in hand.",
                'order'    => 2,
                'status'   => true,
            ]
        );
    }
}
