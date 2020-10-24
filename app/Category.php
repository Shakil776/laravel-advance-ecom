<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    public static function catDetails($url){
    	$catDetails = Category::select('id', 'parent_id', 'category_name', 'category_url', 'category_description')->with(['subcategories'=>function($query){
    		$query->select('id', 'parent_id', 'category_name', 'category_url', 'category_description')->where('status', 1);
    	}])->where('category_url', $url)->first()->toArray();
    	
        if ($catDetails['parent_id'] == 0) {
            // show only main category breadcrumb
            $breadcrumbs = '<a href="'.url($catDetails['category_url']).'">'.$catDetails['category_name'].'</a>';
        }else{
            // show main and sub-category breadcrumb
            $parentCategory = Category::select('category_name', 'category_url')->where('id', $catDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a href="'.url($parentCategory['category_url']).'">'.$parentCategory['category_name'].'</a>&nbsp;<span class="divider">/</span>&nbsp;<a href="'.url($catDetails['category_url']).'">'.$catDetails['category_name'].'</a>';
        }

    	$catIds = [];
    	$catIds[] = $catDetails['id'];
    	foreach ($catDetails['subcategories'] as $key => $subcat) {
    		$catIds[] = $subcat['id'];
    	}

    	return ['catsId'=>$catIds, 'catDetails'=>$catDetails, 'breadcrumbs'=>$breadcrumbs];
    }
}
