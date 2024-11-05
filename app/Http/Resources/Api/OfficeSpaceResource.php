<?php

namespace App\Http\Resources\Api;


use App\Http\Resources\Api\CityResource;
use App\Models\OfficeSpaceBenefit;
use App\Models\OfficeSpaceImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSpaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'duration' => $this->duration,
            'address' => $this->address,
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            // 'city' => new CityResource($this->whenLoaded('city')),
            'city' => new CityResource($this->whenLoaded('city')),
            'is_open' => $this->is_open,
            'is_available' => $this->is_available,
            // 'city' => $this->city->name ?? null,
            'benefits' => OfficeSpaceBenefitResource::collection($this->whenLoaded('benefits')),
            'image' => OfficeSpaceImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
