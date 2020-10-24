<?php

use Illuminate\Database\Seeder;
use App\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliderRecords = [
        	['id'=>1, 'slider_image'=>'slider1.png', 'title'=>'Test title for slider 1', 'alt_text'=>'Alternative text for slide 1', 'link'=>'https://www.facebook.com', 'status'=>1],
        	['id'=>2, 'slider_image'=>'slider2.png', 'title'=>'Test title for slider 2', 'alt_text'=>'Alternative text for slide 2', 'link'=>'https://www.facebook.com', 'status'=>1],
        	['id'=>3, 'slider_image'=>'slider3.png', 'title'=>'Test title for slider 3', 'alt_text'=>'Alternative text for slide 3', 'link'=>'https://www.facebook.com', 'status'=>1]
        ];
        Slider::insert($sliderRecords);
    }
}
