<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;

class UserController extends Controller
{
    // Registeration Method
    public function register(Request $request)
    {

        try{
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
                $user->teacherData()->create([
                    "main_id" => $user->id,
                    "experience" => $request->experience,
                    "expertise_subjects" => $request->expertise_subjects,
                ]);
            }
            elseif ($user->r_id == 3){
                $user->studentData()->create([
                    "main_id" => $user->id,
                    "father_name" => $request->father_name,
                    "mother_name" => $request->mother_name,
                ]);
            } 
    
            $token = $user->createToken('Token')->accessToken;
            return json_encode(["token"=>$token, "user"=>$user]);

        } catch(\Exception $e) {
            return json_encode(["error"=>$e->getMessage()]);
        }
    }
    
    //Login Method
    public function login(Request $request){
        $user = $request->only('email', 'password');
       
        if (auth()->attempt($user)){

            $token = auth()->user()->createToken('Token')->accessToken;
            return json_encode(['Message'=>'User Logged in Successfully.', 'token'=>$token]);
   
        }
        else{            
            return json_encode(['Error'=>'Unauthorized User']);
        }
    }

    //Logout Method
    public function logout()
    {
        auth()->user()->token()->revoke();
        return json_encode(['message' => 'User logged out successfully.' ]);
    }
    
    // Reading Method
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

    // Updation Method
    public function update(Request $request, $id)
    {
        $user = Main::with('studentData', 'teacherData', 'assignStudent', 'assignTeacher')->find($id);

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
    
    // Deletion Method
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
