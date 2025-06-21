<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'description' => $this->description,
            'image' => $this->image,
            'phone' => $this->phone,
            'location' => $this->location,
            'status' => $this->status,

            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'email' => $this->user->email ?? null,
            ],

            'feedbacks' => FeedbackResource::collection($this->whenLoaded('feedbacks')),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}