<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public static function sliders(){
    	// get all active sliders
    	$sliders = Slider::where('status', 1)->get()->toArray();
    	return $sliders;
    }
}
