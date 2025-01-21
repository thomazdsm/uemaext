<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ProjectAssignmentsRequest;
use App\Http\Resources\ProjectAssignmentsResource;
use App\Models\ProjectAssignments;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectAssignmentsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(ProjectAssignments::class, 'projectAssignment');
    }

    public function index(): AnonymousResourceCollection
    {
        $assignments = ProjectAssignments::query()
            ->with(['project', 'user'])
            ->paginate(10);

        return ProjectAssignmentsResource::collection($assignments);
    }

    public function store(ProjectAssignmentsRequest $request): ProjectAssignmentsResource
    {
        $assignment = ProjectAssignments::create($request->validated());

        return new ProjectAssignmentsResource($assignment);
    }

    public function show(ProjectAssignments $projectAssignment): ProjectAssignmentsResource
    {
        return new ProjectAssignmentsResource($projectAssignment->load(['project', 'user']));
    }

    public function update(ProjectAssignmentsRequest $request, ProjectAssignments $projectAssignment): ProjectAssignmentsResource
    {
        $projectAssignment->update($request->validated());

        return new ProjectAssignmentsResource($projectAssignment);
    }

    public function destroy(ProjectAssignments $projectAssignment): JsonResponse
    {
        $projectAssignment->delete();

        return response()->json(null, 204);
    }
}
