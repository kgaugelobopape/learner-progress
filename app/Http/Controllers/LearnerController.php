<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearnerProgressRequest;
use App\Http\Resources\LearnerResource;
use App\Services\CourseService;
use App\Services\LearnerService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LearnerController extends Controller
{
    use ApiResponder;

    private LearnerService $learnerService;
    private CourseService $courseService;

    public function __construct(LearnerService $learnerService, CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->learnerService = $learnerService;
    }

    public function index(): View
    {
        return view("learner-progress");
    }

    /**
     * @param LearnerProgressRequest $request
     * @return JsonResponse
     */
    public function getData(LearnerProgressRequest $request): JsonResponse
    {
        try {
            $learners = $this->learnerService->getAll($request->get("course"), $request->get("sort"));
            return $this->httpResponse(LearnerResource::collection($learners));
        } catch (\Exception $exception) {
            return $this->httpResponse(null, false, 500, $exception->getMessage());
        }
    }
}
