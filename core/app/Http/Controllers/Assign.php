<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Assign extends Controller
{

    public function assign($id)
    {
        $data = json_decode(Http::get('http://localhost:8001/api/assign'.$id));
        return response()->json($data);
    }

}
