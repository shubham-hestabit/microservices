<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'student_id', 'assigned_teacher_id'];

    public function s_data(){
        return $this->belongsTo('App\Models\Student');
    }

    public function t_data(){
        return $this->belongsTo('App\Models\Teacher');
    }

}
