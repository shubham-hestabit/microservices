<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserDataController extends Controller
{
    public $token;

    public function __construct(Request $request)
    {
        $this->token = $request->bearerToken() ?? '';
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $user = json_decode(Http::post('http://localhost:8001/api/register/', $data));
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');   
        $user = json_decode(Http::post('http://localhost:8001/api/login/', $data));
        return response()->json($user);
    }

    public function logout()
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/logout/'));
        return response()->json($user);
    }

    public function read($id)
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/read/'.$id));
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = json_decode(Http::withToken($this->token)->put('http://localhost:8001/api/update/'.$id , $data));
        return response()->json($user);
    
    }

    public function destroy($id)
    {
        $user = json_decode(Http::withToken($this->token)->delete('http://localhost:8001/api/delete/'.$id));
        return response()->json($user);
    }
}
