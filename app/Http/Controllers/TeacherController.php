<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class TeacherController extends Controller
{
    public function courses(){

    }

    public function students(){
    	$students = Students::with('user', 'courses.reviews')
    		->whereHas('courses', function($q){
    			$q->where('teacher_id', auth()->user()->teacher->id)->select('id', 'teacher_id', 'name')->withTrashed();
    		})->get();

    	$actions = 'students.datatables.actions';

    	return \DataTables::of($students)->addColumn('actions', $actions)->rawColumns(['actions'])->make(true);
    }
}
