<?php

namespace App\Services;

use App\Repositories\Interfaces\LearnerRepositoryInterface;
use Illuminate\Support\Collection;

class LearnerService
{
    private LearnerRepositoryInterface $learnerRepository;

    public function __construct(LearnerRepositoryInterface $learnerRepository) {
        $this->learnerRepository = $learnerRepository;
    }

    /**
     * @param string|null $courseName
     * @param string|null $sortBy
     * @return Collection
     */
    public function getAll(?string $courseName = null, ?string $sortBy = null): Collection
    {
        $learners = $courseName
            ? $this->learnerRepository->getByCourseName($courseName)
            : $this->learnerRepository->getAll();

        // Calculate average progress for each learner
        $learners->transform(function ($learner) {
            $totalCourses = $learner->courses->count();
            $coursesProgressSum = $learner->courses->sum(fn($course) => $course->pivot->progress);

            $average = $totalCourses ?  $coursesProgressSum / $totalCourses : 0;

            $learner->average_progress = round($average, 2);
            return $learner;
        });

        if ($sortBy === "progress_asc") {
            $learners = $learners->sortBy("average_progress")->values();
        } elseif ($sortBy === "progress_desc") {
            $learners = $learners->sortByDesc("average_progress")->values();
        }

        return $learners;
    }
}
