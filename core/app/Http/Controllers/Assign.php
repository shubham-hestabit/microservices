<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Assign extends Controller
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
     * Request for the inputs for Assigning the Student to the Teacher with authentication.
     */
    public function assign(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|numeric',
            'assigned_teacher_id' => 'required|numeric',
            'approval_status' => 'numeric',
        ]);
        
        $var = 'hello';

        $data = $request->all();
        $user = json_decode(Http::withToken($this->token)->put('http://localhost:8001/api/assign/'.$id, $data));
        return response()->json($user);
    }

    /** 
     * show the data of student and teacher assigning.
     */
    public function assignedData()
    {
        $user = json_decode(Http::withToken($this->token)->get('http://localhost:8001/api/reads/'));
        return response()->json($user);
    }

}
