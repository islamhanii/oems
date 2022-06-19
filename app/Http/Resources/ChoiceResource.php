<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChoiceResource extends JsonResource
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
            'option' => $this->option,
            'image' => ($this->image)?asset('uploads/' . $this->image):null,
            $this->mergeWhen((Auth::user()->role_id == 2), [
                'right_answer' => ($this->right_answer)?true:false
            ])
        ];
    }
}
