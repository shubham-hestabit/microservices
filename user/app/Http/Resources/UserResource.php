<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->r_id == 2 or $this->r_id == 3) {       
            return [
                'Id' => $this->id,
                'Name' => $this->name,
                'Email' => $this->email,
                'Address' => $this->address,
                'Current School' => $this->current_school,
                'Previous School' => $this->previous_school,
                'Approval Status' => $this->approval_status,
                'Role ID' => $this->r_id
            ];
        }
        else{
            return [
                'Id' => $this->id,
                'Name' => $this->name,
                'Email' => $this->email,
                'Address' => $this->address,
                'Current School' => $this->current_school,
                'Previous School' => $this->previous_school,
                'Role ID' => $this->r_id
            ];
        }
    }
}