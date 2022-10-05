<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Main extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public function studentData(){

        return $this->hasOne('App\Models\Student');
    }

    public function teacherData(){

        return $this->hasOne('App\Models\Teacher');
    }

    public function assignStudent(){

        return $this->hasOneThrough('App\Models\Assign', 'App\Models\Student', 'main_id', 'student_id', 'id', 's_id');
    }

    public function assignTeacher(){

        return $this->hasOneThrough('App\Models\Assign', 'App\Models\Teacher', 'main_id', 'assigned_teacher_id', 'id', 't_id');
    }
}
