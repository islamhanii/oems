<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = ImageResource::collection($this->images()->get());
        $choices = ChoiceResource::collection($this->choices()->get());
        $answer = (Auth::user()->role_id == 1)?$this->users()->where('user_id', Auth::id())->first()->pivot->answer:null;

        return [
            'id' => $this->id,
            'header' => $this->header,
            'diffculty' => $this->diffculty,
            $this->mergeWhen(($request->is('api/questions/show/*') || $request->is('api/exams/*/questions')), [
                'images' => (count($images)>0)?$images:null,
                'choices' => (count($choices)>0)?$choices:null,
            ]),
            $this->mergeWhen(($answer != null), [
                'answer' => $answer
            ]),
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d/m/Y H:i:s', strtotime($this->updated_at))
        ];
    }
}
