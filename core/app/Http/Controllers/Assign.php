<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Assign extends Controller
{
    public $token;

    public function __construct(Request $request)
    {
        $this->token = $request->bearerToken() ?? '';
    }

    public function assign(Request $request, $id)
    {
        $data = $request->all();
        $user = json_decode(Http::withToken($this->token)->put('http://localhost:8001/api/assign/'.$id, $data));
        return response()->json($user);
    }

    public function assignedData()
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/reads/'));
        return response()->json($user);
    }

}
