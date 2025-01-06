<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchByActivityRequest;
use App\Http\Requests\SearchByNameRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;


class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }
    /**
     * Get organizations by building ID
     *
     * @OA\Get(
     *     path="/api/organizations/building/{buildingId}",
     *     summary="Get all organizations in a specific building",
     *     @OA\Parameter(name="buildingId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations in a building",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Building not found")
     * )
     */
    //TO DO - create request
    public function getOrganizationsByBuilding(int $buildingId)
    {
        $organizations = $this->organizationService->getOrganizationsByBuilding($buildingId);
        return OrganizationResource::collection($organizations);
    }
    /**
     * Get organizations by activity ID
     *
     * @OA\Get(
     *     path="/api/organizations/activity/{activityId}",
     *     summary="Get all organizations by activity",
     *     @OA\Parameter(name="activityId", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="List of organizations by activity",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Organization"))
     *     ),
     *     @OA\Response(response=404, description="Activity not found")
     * )
     */
    //TO DO - create request
    public function getOrganizationsByActivity(int $activityId)
    {
        $organizations = $this->organizationService->getOrganizationsByActivity($activityId);
        return OrganizationResource::collection($organizations);
    }
    //TO DO - create request
    public function getOrganizationById(int $organizationId)
    {
        $organization = $this->organizationService->getOrganizationById($organizationId);
        return new OrganizationResource($organization);
    }

    public function searchOrganizationsByActivity(SearchByActivityRequest $request)
    {
        $organizations = $this->organizationService->searchOrganizationsByActivity($request->activity_id);
        return OrganizationResource::collection($organizations);
    }

    public function searchOrganizationsByName(SearchByNameRequest $request)
    {
        $organizations = $this->organizationService->searchOrganizationsByName($request->name);
        return OrganizationResource::collection($organizations);
    }
}
