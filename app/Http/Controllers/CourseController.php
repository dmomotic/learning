<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function show(Course $course){
    	dd($course);
    }
}
