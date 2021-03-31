<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index(){
    	return view('teacher.index');
    }

    public function all_teacher(){
    	 $teachers = Teacher::latest()->get();
    	 return response()->json($teachers);
    }

    public function add(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'title' => 'required',
    		'institute' => 'required',
    	]);

    	$teacher = new Teacher();
    	$teacher->name = $request->name;
    	$teacher->title = $request->title;
    	$teacher->institute = $request->institute;
    	$teacher->save();
    	return response()->json($teacher);
    }

    public function edit_teacher(Request $request){
    	$teacher = Teacher::findorFail($request->id);
    	return response()->json($teacher);
    }

    public function update(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'title' => 'required',
    		'institute' => 'required',
    	]);

    	$teacher = Teacher::find($request->id);
    	$teacher->name = $request->name;
    	$teacher->title = $request->title;
    	$teacher->institute = $request->institute;
    	$teacher->save();
    	return response()->json($teacher);
    }

    public function delete(Request $request){
    	$teacher = Teacher::find($request->id)->delete();
    	return response()->json(['messege' => 'Data Successfully Deleted ']);
    }
}
