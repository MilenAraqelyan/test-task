<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Building",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="latitude", type="number", format="float"),
 *     @OA\Property(property="longitude", type="number", format="float")
 * )
 */
class BuildingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
