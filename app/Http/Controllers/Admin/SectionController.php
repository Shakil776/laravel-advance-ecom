<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    // show sections
    public function sections(){
        $sections = Section::get();
        return view('layouts.admin_layouts.sections.section')->with(compact('sections'));
    }

    // change section status
    public function changeSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'section_id' => $data['section_id']
            ]);
        }
    }



}
