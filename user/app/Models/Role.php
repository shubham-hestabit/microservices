<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Make the 'r_id' column protected.
     */
    protected $primaryKey = 'r_id';

    /** Make a public function for  relationship*/
    public function role(){

        return $this->hasOne('App\Models\Main');
    }
}
