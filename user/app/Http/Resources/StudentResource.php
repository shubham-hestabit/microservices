<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'Student ID' => $this->studentData->s_id,
            'Name' => $this->name,
            'Email' => $this->email,
            'Address' => $this->address,
            'Current School' => $this->current_school,
            'Previous School' => $this->previous_school,
            'Father Name' => $this->studentData->father_name, 
            'Mother Name' => $this->studentData->mother_name,
            'Approval Status' => $this->approval_status,
        ];
    }
}
