<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Requests\ReportRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReportController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->authorizeResource(Report::class, 'report');
    }

    public function index(): AnonymousResourceCollection
    {
        $reports = Report::query()
            ->with(['project', 'status'])
            ->paginate(10);

        return ReportResource::collection($reports);
    }

    public function store(ReportRequest $request): ReportResource
    {
        $report = Report::create($request->validated());

        return new ReportResource($report);
    }

    public function show(Report $report): ReportResource
    {
        return new ReportResource($report->load(['project', 'status']));
    }

    public function update(ReportRequest $request, Report $report): ReportResource
    {
        $report->update($request->validated());

        return new ReportResource($report);
    }

    public function destroy(Report $report): JsonResponse
    {
        $report->delete();

        return response()->json(null, 204);
    }
}
