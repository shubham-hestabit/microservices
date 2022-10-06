<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $primaryKey = 't_id';

    protected $fillable = ['user_id', 'experience', 'expertise_subjects'];

    public function teacher_data(){
        
        return $this->belongsTo('App\Models\Main');
    }
}
