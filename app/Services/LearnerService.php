<?php

namespace App\Services;

use App\Repositories\Interfaces\LearnerRepositoryInterface;

class LearnerProgressService
{
    private LearnerRepositoryInterface $enrolmentRepository;

    public function __construct(LearnerRepositoryInterface $enrolmentRepository) {
        $this->enrolmentRepository = $enrolmentRepository;
    }

    /**
     * @param string|null $courseName
     * @param string|null $sortBy
     * @return array
     */
    public function getLearnerProgress(?string $courseName = null, ?string $sortBy = null): array
    {
        $enrolments = $courseName
            ? $this->enrolmentRepository->getByCourseName($courseName)
            : $this->enrolmentRepository->getAllWithRelations();

        $groupedByLearner = $enrolments->groupBy("learner_id");

        $learners = $groupedByLearner->map(function ($learnerEnrolments) {
            $firstEnrolment = $learnerEnrolments->first();

            return [
                "id" => $firstEnrolment->learner->id,
                "name" => $firstEnrolment->learner->name,
                "courses" => $learnerEnrolments->map(function ($enrolment) {
                    return [
                        "id" => $enrolment->course->id,
                        "name" => $enrolment->course->name,
                        "progress" => $enrolment->progress_percentage,
                    ];
                })->values()->toArray(),
                "average_progress" => round($learnerEnrolments->avg("progress_percentage"), 2),
            ];
        })->values();

        if ($sortBy === "progress_asc") {
            $learners = $learners->sortBy("average_progress")->values();
        } elseif ($sortBy === "progress_desc") {
            $learners = $learners->sortByDesc("average_progress")->values();
        }

        return $learners->toArray();
    }

    /**
     * @return array
     */
    public function getAllCourseNames(): array
    {
        return $this->enrolmentRepository->getAllCourseNames()->toArray();
    }
}
