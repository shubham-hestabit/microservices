<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /** 
     * Make 's_id' column primary key.
     */
    protected $primaryKey = 's_id';

    /** 
     * Make below column's fillable.
     */
    protected $fillable = ['user_id', 'father_name', 'mother_name'];

    /**
     * Make below function for a relationship with Main Model.
     */
    public function student_data(){
        
        return $this->belongsTo('App\Models\Main');
    }
}

