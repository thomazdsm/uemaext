<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(Department::class, 'department');
    }

    public function index(): AnonymousResourceCollection
    {
        $departments = Department::query()->paginate(10);

        return DepartmentResource::collection($departments);
    }

    public function store(DepartmentRequest $request): DepartmentResource
    {
        $department = Department::create($request->validated());

        return new DepartmentResource($department);
    }

    public function show(Department $department): DepartmentResource
    {
        return new DepartmentResource($department);
    }

    public function update(DepartmentRequest $request, Department $department): DepartmentResource
    {
        $department->update($request->validated());

        return new DepartmentResource($department);
    }

    public function destroy(Department $department): JsonResponse
    {
        $department->delete();

        return response()->json(null, 204);
    }
}
