<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        // Получаем только корневые активности (первый уровень)
        $activities = Activity::whereNull('parent_id')
            ->with(['children', 'organizations'])
            ->get();
        return ActivityResource::collection($activities);
    }

    public function show(Activity $activity)
    {
        return new ActivityResource($activity->load(['children', 'organizations']));
    }
}
