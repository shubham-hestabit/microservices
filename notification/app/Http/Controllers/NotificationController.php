<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Notifications\TeacherNotification;
use App\Models\Teacher;
use App\Models\Main;

class NotificationController extends Controller
{
    public function email(Request $request)
    {   
        $messages = $request->only('user_email', 'title', 'body');

        Mail::to($messages['user_email'])->send(new SendMail ($messages));

        return json_encode(["Message" => "Email sent Successfully."]);
    }

    public function notification(Request $request)
    {  
        $tid = $request['teacher_id'];

        $teacher = Teacher::find($tid);
        $teacher_main = $teacher->main_id;

        $user_teacher = Main::find($teacher_main);
        $t_email = $user_teacher->email;

        $user_teacher->notify(new TeacherNotification($t_email));

        return json_encode(['Message' =>"A new Notification sent Successfully to the Teacher."]);
    }
}
