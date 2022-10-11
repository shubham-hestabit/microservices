<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Main extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * make the ID column primary key..
     */
    protected $primaryKey = 'id';

    /** 
     * Make the password column hidden for security purposes.
     */
    protected $hidden = [ 'password'];

    /** 
     * Apply one to one relationship on studentData() function.
     */
    public function studentData(){

        return $this->hasOne('App\Models\Student');
    }

    /** 
     * Apply one to one relationship on teacherData() function.
     */
    public function teacherData(){

        return $this->hasOne('App\Models\Teacher');
    }

    /** 
     * Apply one to many relationship on assignStudent() function.
     */
    public function assignStudent(){

        return $this->hasOneThrough('App\Models\Assign', 'App\Models\Student', 'main_id', 'student_id', 'id', 's_id');
    }

    /** 
     * Apply one to many relationship on assignTeacher() function.
     */
    public function assignTeacher(){

        return $this->hasOneThrough('App\Models\Assign', 'App\Models\Teacher', 'main_id', 'assigned_teacher_id', 'id', 't_id');
    }
}
