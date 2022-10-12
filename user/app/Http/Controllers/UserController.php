<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;

class UserController extends Controller
{
    /** 
     * This is a User Registeration method.
    */ 
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'picture' => 'image',
            'current_school' => 'required',
            'previous_school' => 'required',
            'password' => 'required|min:8|max:100',
        ]);

        $user = new Main();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->current_school = $request->current_school;
        $user->previous_school = $request->previous_school;
        $user->password = bcrypt($request->password);
        $user->r_id = $request->r_id ?? 3;
        $user->approval_status = 0;
        $user->save();
        
        if($user->r_id == 1){
            $user->approval_status = 1;
            $user->save();
        }
        elseif($user->r_id == 2){
            $request->validate([
                "experience" => 'required',
                "expertise_subjects" => 'required',
            ]);
            $user->teacherData()->create([
                "main_id" => $user->id,
                "expertise_subjects" => $request->expertise_subjects,
                "experience" => $request->experience,
            ]);
        }
        elseif ($user->r_id == 3){
            $request->validate([
                "father_name" => 'required',
                "mother_name" => 'required',
            ]);
            $user->studentData()->create([
                "main_id" => $user->id,
                "father_name" => $request->father_name,
                "mother_name" => $request->mother_name,
            ]);
        } 
            
        $token = $user->createToken('Token')->accessToken;
        return json_encode(["Token"=>$token, "User"=>$user]);

    }
    
    /** 
     * This is a User Login method.
     * This method generate a token for Authentication.
    */ 
    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:100',
        ]);

        $user = $request->only('email', 'password');
       
        if (auth()->attempt($user)){

            $token = auth()->user()->createToken('Token')->accessToken;
            return json_encode(['Message'=>'User Logged in Successfully.', 'token'=>$token]);
   
        }
        else{            
            return json_encode(['Error'=>'Unauthorized User']);
        }
    }

    /** 
     * This method is for Logout the User.
    */ 
    public function logout()
    {
        auth()->user()->token()->revoke();
        return json_encode(['message' => 'User logged out successfully.' ]);
    }
    
    /** 
     * We create this method for checking the User details.
     * Reading Method 
    */ 
    public function read($id)
    {
        $user = Main::with('studentData', 'teacherData', 'assignStudent', 'assignTeacher')->find($id);

        try{
            if($user == null){
                throw new \Exception("User data not found.");
            }
            return json_encode(["User Data:" => $user]);
        }
        catch(\Exception $e){
            return json_encode(['Error: '=> $e->getMessage()]);
        }
    }

    /** 
     * We create this method for Update the User details.
     * Updation Method
    */ 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'regex:/^[a-zA-ZÑñ\s]+$/',
            'email' => 'email',
            'address' => 'string',
            'current_school' => 'string',
            'previous_school' => 'string',
            'password' => 'string',
            'experience' => 'numeric',
            'expertise_subjects' => 'string',
            'father_name' => 'string',
            'mother_name' => 'string',
        ]);

        $user = Main::with('studentData', 'teacherData')->find($id);

        try{
            if(is_null($user)){
                throw new \Exception("User data not found for Updation.");
            }
            else{
                $user->name = $request->name ?? $user->name;
                $user->email = $request->email ?? $user->email;
                $user->address = $request->address ?? $user->address;
                $user->current_school = $request->current_school ?? $user->current_school;
                $user->previous_school = $request->previous_school ?? $user->previous_school;
                $user->password = bcrypt($request->password) ?? $user->password;
                $user->save();
        
                if($user->r_id == 2){
                    $user->teacherData()->update([
                        'experience' => $request->experience ?? $user->experience,
                        'expertise_subjects' => $request->expertise_subjects ?? $user->expertise_subjects,
                    ]);
                    return json_encode(["Teacher Data Updated:" => $user]);
                }
                elseif ($user->r_id == 3){
                    $user->studentData()->update([
                        "father_name" => $request->father_name ?? $user->father_name,
                        "mother_name" => $request->mother_name ?? $user->mother_name,
                    ]);
                    return json_encode(["Student Data Updated:" => $user]);
                }
            }
        }
        catch(\Exception $e){
            return json_encode(['Error: '=> $e->getMessage()]);    
        }
    }
    
    /** 
     * We create this method for Delete the User details.
     * Delete Method
    */ 
    public function destroy($id)
    {
        if (auth()->user()->r_id == 1){
            $user = Main::find($id);
            $user->delete();
            return json_encode(['message' => 'User deleted successfully.']);    
        }
        else{
            return json_encode(['message' => 'Unauthorized User']);
        }
    }
}
