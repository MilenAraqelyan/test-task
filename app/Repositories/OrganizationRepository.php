<?php

namespace App\Repositories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

/**
 * @OA\Tag(
 *     name="Organization",
 *     description="Operations related to Organizations"
 * )
 */
class OrganizationRepository
{
    /**
     * Get all organizations by building ID.
     *
     * @OA\Get(
     *     path="/organizations/building/{buildingId}",
     *     summary="Get organizations by building",
     *     description="Retrieve all organizations located in a specific building.",
     *     operationId="getAllByBuildingId",
     *     tags={"Organization"},
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Building not found")
     * )
     */
    public function getAllByBuildingId(int $buildingId): Collection
    {
        return Organization::where('building_id', $buildingId)->get();
    }

    /**
     * Get all organizations by activity ID.
     *
     * @OA\Get(
     *     path="/organizations/activity/{activityId}",
     *     summary="Get organizations by activity",
     *     description="Retrieve all organizations associated with a specific activity.",
     *     operationId="getAllByActivityId",
     *     tags={"Organization"},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Activity not found")
     * )
     */
    public function getAllByActivityId(int $activityId): Collection
    {
        return Organization::whereHas('activities', function ($query) use ($activityId) {
            $query->where('activities.id', $activityId);
        })->get();
    }

    /**
     * Get an organization by ID.
     *
     * @OA\Get(
     *     path="/organizations/{organizationId}",
     *     summary="Get organization by ID",
     *     description="Retrieve details of a specific organization.",
     *     operationId="getById",
     *     tags={"Organization"},
     *     @OA\Parameter(
     *         name="organizationId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Organization details",
     *         @OA\JsonContent(ref="#/components/schemas/Organization")
     *     ),
     *     @OA\Response(response=404, description="Organization not found")
     * )
     */
    public function getById(int $organizationId): ?Organization
    {
        return Organization::find($organizationId);
    }

    /**
     * Search organizations by activity, including parent activity.
     *
     * @OA\Get(
     *     path="/organizations/search/activity/{activityId}",
     *     summary="Search organizations by activity",
     *     description="Search organizations based on activity and its parent activity.",
     *     operationId="searchByActivity",
     *     tags={"Organization"},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Activity not found")
     * )
     */
    public function searchByActivity(int $activityId): Collection
    {
        return Organization::whereHas('activities', function ($query) use ($activityId) {
            $query->where('activities.id', $activityId)
                ->orWhere('activities.parent_id', $activityId);
        })->get();
    }

    /**
     * Search organizations by name.
     *
     * @OA\Get(
     *     path="/organizations/search/name",
     *     summary="Search organizations by name",
     *     description="Search organizations by name, returning a list of matching organizations.",
     *     operationId="searchByName",
     *     tags={"Organization"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Organizations not found")
     * )
     */
    public function searchByName(string $name): Collection
    {
        return Organization::where('name', 'like', '%' . $name . '%')->get();
    }
}
