<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Admin ID' => $this->r_id,
            'Student ID' => $this->studentData->assignStudent->student_id,
            'Teacher ID' => $this->teacherData->assignTeacher->assigned_teacher_id,
        ];
    }
}
