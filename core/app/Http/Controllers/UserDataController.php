<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserDataController extends Controller
{
    public $token;

    /** 
     * Request for the Bearer Token for Authentication.
     */
    public function __construct(Request $request)
    {
        $this->token = $request->bearerToken() ?? '';
    }

    /** 
     * Request for the inputs for Registeration.
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $user = json_decode(Http::post('http://localhost:8001/api/register/', $data));
        return response()->json($user);
    }

    /** 
     * Request for the inputs for Login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:100',
        ]);

        $data = $request->only('email', 'password');   
        $user = json_decode(Http::post('http://localhost:8001/api/login/', $data));
        return response()->json($user);
    }

    /** 
     * LogOut the User with Authentication.
     */
    public function logout()
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/logout/'));
        return response()->json($user);
    }

    /** 
     * Take ID with Authentication for the Showing the Registered user data.
     */
    public function read($id)
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/read/'.$id));
        return response()->json($user);
    }

    /** 
     * Request for inputs and ID with Authentication for the Update the User Data.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = json_decode(Http::withToken($this->token)->put('http://localhost:8001/api/update/'.$id , $data));
        return response()->json($user);
    
    }

    /** 
     * Take ID with Authentication for the Deleting the Registered user data .
     */
    public function destroy($id)
    {
        $user = json_decode(Http::withToken($this->token)->delete('http://localhost:8001/api/delete/'.$id));
        return response()->json($user);
    }
}
