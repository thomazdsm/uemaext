<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(Activity::class, 'activity');
    }

    public function index(): AnonymousResourceCollection
    {
        $activities = Activity::query()
            ->with(['project', 'status'])
            ->paginate(10);

        return ActivityResource::collection($activities);
    }

    public function store(ActivityRequest $request): ActivityResource
    {
        $activity = Activity::create($request->validated());

        return new ActivityResource($activity);
    }

    public function show(Activity $activity): ActivityResource
    {
        return new ActivityResource($activity->load(['project', 'status']));
    }

    public function update(ActivityRequest $request, Activity $activity): ActivityResource
    {
        $activity->update($request->validated());

        return new ActivityResource($activity);
    }

    public function destroy(Activity $activity): JsonResponse
    {
        $activity->delete();

        return response()->json(null, 204);
    }
}
