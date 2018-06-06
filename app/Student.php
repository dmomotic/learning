<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Student
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUserId($value)
 */
class Student extends Model
{
	protected $fillable = ['user_id', 'title'];

	//permite retornar desde get
	protected $appends = ['courses_formatted'];

    public function courses(){
    	return $this->belongsToMany(Course::class);
    }

    public function user(){
    	return $this->belongsTo(User::class)->select('id', 'role_id', 'name', 'email');
    }

    public function getCoursesFormattedAttribute() {
    	//retorna 'curso 1, curso 2, curso 3, ... curso n'
    	return $this->courses->pluck('name')->implode(', ');
    }
}
