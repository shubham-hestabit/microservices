<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Assign;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{

    /**
     * Approve the user profile.
     * Assigns the student to Teacher.
     * Send an Email to user on Profile Appraval.
     * Send an Notification and Email to the Teacher on each student assigning.
     */
    public function assign(Request $request, $id){
        
        $user = Main::with('studentData', 'teacherData', 'assignStudent', 'assignTeacher')->find($id);
        
        try{
            if(is_null($user)){
                throw new \Exception("Data not found for Updation.");
            }
            
            if(auth()->user()->r_id == 1){
            
                $user->approval_status = $request->approval_status ?? 0;
                $user->save();
                
                if ($user->approval_status == 1){

                    $messages = [
                        'user_email' => $user->email,
                        'title' => 'Congratulations!',
                        'body' => 'You Profile is Approved by Admin.',
                    ];
                    
                    $userMail = json_decode(Http::post('http://localhost:8002/api/email', $messages));
                } 
                    
                $user->assignStudent()->insert([
                    'student_id' => $request->student_id ?? 0,
                    'assigned_teacher_id' => $request->assigned_teacher_id ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]); 

                $teach_id = ['teacher_id' => $request->assigned_teacher_id];

                $userNotify = json_encode(Http::post('http://localhost:8002/api/notification', $teach_id));

                return json_encode([
                    'Success:' => 'Email and Notification send Successfully.'
                ]);  
            }
        }
        catch(\Exception $e){
            return json_encode(['Error:' => $e->getMessage()]);  
        }
    }

    /**
     * this function is used for getting the Assign table data.
     */
    public function read()
    {
        $assign = Assign::get();

        return json_encode(['Data' => $assign]); 
    }
}