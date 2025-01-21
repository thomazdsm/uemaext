<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }

    /**
     * Display a listing of the projects.
     */
    public function index() : AnonymousResourceCollection
    {
        $projects = Project::query()
            ->with(['department', 'status', 'type'])
            ->paginate(10);

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created project.
     */
    public function store(ProjectRequest $request) : ProjectResource
    {
        $project = Project::create($request->validated());

        return new ProjectResource($project);
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project) : ProjectResource
    {
        return new ProjectResource($project->load(['department', 'status', 'type']));
    }

    /**
     * Update the specified project.
     */
    public function update(ProjectRequest $request, Project $project) : ProjectResource
    {
        $project->update($request->validated());

        return new ProjectResource($project);
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project) : JsonResponse
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
