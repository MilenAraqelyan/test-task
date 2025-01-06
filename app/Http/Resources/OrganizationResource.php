<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Organization",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="building", type="object", ref="#/components/schemas/Building"),
 *     @OA\Property(property="phones", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="activities", type="array", @OA\Items(ref="#/components/schemas/Activity"))
 * )
 */
class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'building' => new BuildingResource($this->building), // Single BuildingResource
            'phones' => PhoneResource::collection($this->phones), // Collection of PhoneResource
            'activities' => ActivityResource::collection($this->activities), // Collection of ActivityResource
        ];
    }
}
