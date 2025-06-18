<?php

namespace App\Http\Resources;

use App\Models\Complaint;
use App\Models\EmergencyRequest;
use App\Models\MerchandiseOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // hitung total dari model lain pakai query langsung
        $totalComplaint = Complaint::where('user_id', $this->id)->count();
        $totalEmergencyRequest = EmergencyRequest::where('user_id', $this->id)->count();
        $totalOrder = MerchandiseOrder::where('user_id', $this->id)->count();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'activities' => [
                'total_complaint' => $totalComplaint,
                'total_emergency_request' => $totalEmergencyRequest,
                'total_order' => $totalOrder,
            ],
        ];
    }
}