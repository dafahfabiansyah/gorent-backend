<?php

namespace App\Http\Resources\Api;

use App\Models\OfficeSpace;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'officeSpace_count' => $this->office_spaces_count, // Sesuai dengan hasil `withCount`
            'officeSpace' => OfficeSpaceResource::collection($this->whenLoaded('officeSpaces'))
        ];
        
    }
}
