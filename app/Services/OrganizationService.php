<?php

namespace App\Services;

use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @OA\Tag(
 *     name="Organization",
 *     description="Operations related to Organizations"
 * )
 */
class OrganizationService
{
    protected $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * Get all organizations in a specific building.
     *
     * @OA\Get(
     *     path="/organizations/building/{buildingId}",
     *     summary="Get organizations by building",
     *     description="Retrieve all organizations located in a specified building.",
     *     operationId="getOrganizationsByBuilding",
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
    public function getOrganizationsByBuilding(int $buildingId): Collection
    {
        return $this->organizationRepository->getAllByBuildingId($buildingId);
    }

    /**
     * Get all organizations related to a specific activity.
     *
     * @OA\Get(
     *     path="/organizations/activity/{activityId}",
     *     summary="Get organizations by activity",
     *     description="Retrieve all organizations engaged in a specific activity.",
     *     operationId="getOrganizationsByActivity",
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
    public function getOrganizationsByActivity(int $activityId): Collection
    {
        return $this->organizationRepository->getAllByActivityId($activityId);
    }

    /**
     * Get a specific organization by its ID.
     *
     * @OA\Get(
     *     path="/organizations/{organizationId}",
     *     summary="Get organization by ID",
     *     description="Retrieve details of an organization by its ID.",
     *     operationId="getOrganizationById",
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
    public function getOrganizationById(int $organizationId): ?Organization
    {
        return $this->organizationRepository->getById($organizationId);
    }

    /**
     * Search organizations by activity, including nested activities.
     *
     * @OA\Get(
     *     path="/organizations/search/activity/{activityId}",
     *     summary="Search organizations by activity",
     *     description="Search organizations by activity and its sub-activities.",
     *     operationId="searchOrganizationsByActivity",
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
    public function searchOrganizationsByActivity(int $activityId): Collection
    {
        return $this->organizationRepository->searchByActivity($activityId);
    }

    /**
     * Search organizations by name.
     *
     * @OA\Get(
     *     path="/organizations/search/name",
     *     summary="Search organizations by name",
     *     description="Search organizations by name, returning a list of matching organizations.",
     *     operationId="searchOrganizationsByName",
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
    public function searchOrganizationsByName(string $name): Collection
    {
        return $this->organizationRepository->searchByName($name);
    }
}
