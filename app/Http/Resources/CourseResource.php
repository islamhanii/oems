<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CourseResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'image' => $this->image,
            'status' => ($this->active)?'open':'close',
            $this->mergeWhen($request->is('api/courses/show/*'), [
                $this->mergeWhen(Auth::user()->role_id == 2, [
                    'access_code' => $this->access_code
                ]),
                'description' => $this->description,
                'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at)),
                'updated_at' => date('d/m/Y H:i:s', strtotime($this->updated_at))
            ]),
            'instructor' => new UserResource($this->users()->where('role_id', 2)->first())
        ];
    }
}
