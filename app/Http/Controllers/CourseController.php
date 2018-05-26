<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\NewStudentInCourse;

class CourseController extends Controller
{
    public function show(Course $course){
    	$course->load([
			'category' => function ($q) {
				$q->select('id', 'name');
			},
			'goals' => function ($q) {
				$q->select('id', 'course_id', 'goal');
			},
			'level' => function ($q) {
				$q->select('id', 'name');
			},
			'requirements' => function ($q) {
				$q->select('id', 'course_id', 'requirement');
			},
			'reviews.user',
			'teacher'
		])->get();

		$related = $course->relatedCourses();

		return view('courses.detail', compact('course', 'related'));
    }

    public function inscribe(Course $course){
    	$course->students()->attach(auth()->user()->student->id);

    	\Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));

    	return back()->with('message', ['success', __("Inscrito correctamente al curso")]);
    }

    public function subscribed(){
    	$courses = Course::whereHas('students', function($query){
    		$query->where('user_id', auth()->id());
    	})->get();

    	return view('courses.subscribed', compact('courses'));
    }
}
