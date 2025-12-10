<?php

namespace App\Repositories;

use App\Models\Enrolment;
use App\Models\Learner;
use App\Repositories\Interfaces\LearnerRepositoryInterface;
use Illuminate\Support\Collection;

class LearnerRepository implements LearnerRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Learner::with(["courses.enrolments"])->get();
    }

    /**
     * @param string $courseName
     * @return Collection
     */
    public function getByCourseName(string $courseName): Collection
    {
        return Enrolment::with(["learner", "course"])
            ->whereHas("course", function ($query) use ($courseName) {
                $query->where("name", $courseName);
            })
            ->get();
    }

    /**
     * @return Collection
     */
    public function getAllCourseNames(): Collection
    {
        return Enrolment::with("course")
            ->get()
            ->pluck("course.name")
            ->unique()
            ->sort()
            ->values();
    }
}
