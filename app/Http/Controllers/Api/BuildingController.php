<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::with('organizations')->paginate(10);
        return BuildingResource::collection($buildings);
    }

    public function show(Building $building)
    {
        return new BuildingResource($building->load('organizations'));
    }
}
