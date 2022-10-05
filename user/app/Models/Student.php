<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 's_id';

    protected $fillable = ['user_id', 'father_name', 'mother_name'];

    public function student_data(){
        
        return $this->belongsTo('App\Models\Main');
    }
}

