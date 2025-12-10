<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    use ApiResponder;

    private CourseService $courseService;

    /**
     * @param CourseService $courseService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        try {
            $courses = $this->courseService->getAll();
            return $this->httpResponse(CourseResource::collection($courses));
        } catch (\Exception $exception) {
            return $this->httpResponse(null, false, 500, $exception->getMessage());
        }
    }
}
