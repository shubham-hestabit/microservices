<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Mail\SendMail;
use App\Models\Assign;
use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TeacherNotification;

class AdminController extends Controller
{

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
                        'title' => 'Congratulations!',
                        'body' => 'You Profile is Approved by Admin.',
                    ];
                    $user_email = $user->email;
                    Mail::to($user_email)->send(new SendMail ($messages));
                    echo "Profile Approval mail sent successfully to the User.<br><br><br>";
                } 
                    
                date_default_timezone_set('Asia/Kolkata');
                $user->assignStudent()->insert([
                'student_id' => $request->student_id ?? 0,
                'assigned_teacher_id' => $request->assigned_teacher_id ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

                $td = $request->assigned_teacher_id;

                $teacher = Teacher::find($td);
                $teacher_main = $teacher->main_id;
                
                $user_teacher = Main::find($teacher_main);
                $t_email = $user_teacher->email;
                
                $user_teacher->notify(new TeacherNotification($t_email));

                return "A new Notification sent successfully to the Teacher.";
            
            }
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function read()
    {
        $assign = Assign::get();

        return response()->json($assign); 
    }
}