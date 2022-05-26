<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'header' => $this->header,
            'diffculty' => $this->diffculty,
            $this->mergeWhen($request->is('api/questions/show/*'), [
                'images' => (count($images)>0)?$images:null,
                'choices' => (count($choices)>0)?$choices:null,
            ]),
            'created_at' => date('d/m/Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d/m/Y H:i:s', strtotime($this->updated_at))
        ];
    }
}
