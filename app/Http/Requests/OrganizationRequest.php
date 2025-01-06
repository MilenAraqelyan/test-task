<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="OrganizationRequest",
 *     type="object",
 *     @OA\Property(property="building_id", type="integer", description="The ID of the building where the organization is located"),
 *     @OA\Property(property="activity_id", type="integer", description="The ID of the activity the organization is engaged in"),
 *     @OA\Property(property="latitude", type="number", format="float", description="The latitude of the organization"),
 *     @OA\Property(property="longitude", type="number", format="float", description="The longitude of the organization"),
 *     @OA\Property(property="radius", type="number", format="float", description="The radius to search for organizations"),
 *     @OA\Property(property="name", type="string", description="The name of the organization")
 * )
 */
class OrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'building_id' => 'nullable|exists:buildings,id',
            'activity_id' => 'nullable|exists:activities,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius' => 'nullable|numeric',
            'name' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'building_id.exists' => 'Здание с таким ID не найдено.',
            'activity_id.exists' => 'Деятельность с таким ID не найдена.',
            'latitude.numeric' => 'Широта должна быть числом.',
            'longitude.numeric' => 'Долгота должна быть числом.',
            'radius.numeric' => 'Радиус должен быть числом.',
            'name.string' => 'Название должно быть строкой.',
        ];
    }
}
