<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function categories(){
        return $this->hasMany('App\Category', 'section_id')->where(['parent_id'=>0, 'status'=>1])->with('subcategories');
    }

    public static function sections(){
    	$getCategories = Section::with('categories')->where('status', 1)->get();
    	$getCategories = json_decode(json_encode($getCategories), true);
    	return $getCategories;
    }
}
