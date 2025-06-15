<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'message' => $this->message,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'email' => $this->user->email ?? null,
            ],
            'complaint' => [
                'id' => $this->complaint->id ?? null,
                'subject' => $this->complaint->subject ?? null,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}