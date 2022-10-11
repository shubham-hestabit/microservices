<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    use HasFactory;

    /**
     * Make the ID column primary key..
     */
    protected $primaryKey = 'id';

    /**
     * Make the below columns fillable.
     */
    protected $fillable = ['id', 'student_id', 'assigned_teacher_id'];

    /**
     * Apply relationship with Student model.
     */
    public function s_data(){
        return $this->belongsTo('App\Models\Student');
    }

    /**
     * Make below function for a relationship with Teacher Model.
     */
    public function t_data(){
        return $this->belongsTo('App\Models\Teacher');
    }

}
