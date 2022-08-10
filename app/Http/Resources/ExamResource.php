<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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

        if($request->is('api/exams/*/questions')) {
            $questions = Auth::user()->questions()->where('exam_id', $request->exam_id)->inRandomOrder()->get();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'duration_minutes' => $this->duration_minutes,
            'totle' => $this->totle,
            'active_minutes' => $this->active_minutes,
            $this->mergeWhen(Auth::user()->role_id == 2, [
                'banks' => BankResource::collection($this->banks()->get()),
                'questions' => QuestionResource::collection($this->questions()->get())
            ]),
            $this->mergeWhen($request->is('api/exams/*/questions'), [
                'questions' => QuestionResource::collection($questions),
                'number_of_questions' => count($questions)
            ]),
            'started_at' => date('d/m/Y H:i:s', strtotime($this->started_at)),
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d/m/Y H:i:s', strtotime($this->updated_at)),
        ];
    }
}
