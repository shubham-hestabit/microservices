<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * Make the 't_id' column primary key.
     */
    protected $primaryKey = 't_id';

    /** 
     * Make below column's fillable.
     */
    protected $fillable = ['user_id', 'experience', 'expertise_subjects'];

    /**
     * Make below function for a relationship with Main Model.
     */
    public function teacher_data(){
        
        return $this->belongsTo('App\Models\Main');
    }
}
