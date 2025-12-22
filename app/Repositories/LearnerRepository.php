<?php

namespace App\Repositories;

use App\Models\Learner;
use App\Repositories\Interfaces\LearnerRepositoryInterface;
use Illuminate\Support\Collection;

class LearnerRepository implements LearnerRepositoryInterface
{
    /**
     * @param string|null $sortBy
     * @param int $paginate
     * @return Collection
     */
    public function getAll(string $sortBy = null, int $paginate = 15): Collection
    {
        $learners = Learner::with(["courses"])
            ->withAvg("enrolments as average_progress", "progress");

        if ($sortBy === "desc") {
            $learners->orderBy("average_progress", "DESC");
        } elseif ($sortBy === "asc") {
            $learners->orderBy("average_progress");
        }

        return $learners->get();
    }

    /**
     * @param string|null $courseName
     * @param string|null $sortBy
     * @param int $paginate
     * @return Collection
     */
    public function getByCourseName(string $courseName = null, string $sortBy = null, int $paginate = 15): Collection
    {
        $learners = Learner::with(["courses"])
            ->withAvg("enrolments as average_progress", "progress")
            ->whereHas("courses", function ($query) use ($courseName) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($courseName) . '%']);
            });

        if ($sortBy === "desc") {
            $learners->orderBy("average_progress", "DESC");
        } elseif ($sortBy === "asc") {
            $learners->orderBy("average_progress", "ASC");
        }

        return $learners->get();
    }
}
