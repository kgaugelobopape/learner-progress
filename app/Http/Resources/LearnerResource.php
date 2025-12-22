<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LearnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->full_name,
            "courses" => $this->whenLoaded("courses")->map(function ($course){
                return [
                    "id"       => $course->id,
                    "name"     => $course->name,
                    "progress" => $course->pivot->progress ?? 0
                ];
            }),
            "lastname" => $this->lastname,
            "firstname" => $this->firstname,
            "average_progress" => round($this->average_progress),
        ];
    }
}
