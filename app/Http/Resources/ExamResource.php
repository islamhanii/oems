<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $questions = [];

        if($request->is('api/exams/show/*/questions')) {
            $questions = Auth::user()->questions()->inRandomOrder()->get();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'duration_minutes' => $this->duration_minutes,
            'totle' => $this->totle,
            $this->mergeWhen(Auth::user()->role_id == 2, [
                'active_minutes' => $this->active_minutes
            ]),
            $this->mergeWhen($request->is('api/exams/show/*/questions'), [
                'questions' => QuestionResource::collection($questions),
                'number_of_questions' => count($questions)
            ]),
            'started_at' => date('d/m/Y H:i:s', strtotime($this->started_at)),
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d/m/Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
