<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TeacherNotification;

class NotifcationController extends Controller
{
    public function email(Request $request)
    {   
        $messages = $request->only('user_email', 'title', 'body');

        Mail::to($messages['user_email'])->send(new SendMail ($messages));

        return json_encode(["Message" => "Email sent successfully."]);
    }











    // public function notification($teacher_main_id)
    // {  
    //     $user_teacher = Main::find($teacher_main_id);
    //     $t_email = $user_teacher->email;
    //     $user_teacher->notify(new TeacherNotification($t_email));
    // }

}
