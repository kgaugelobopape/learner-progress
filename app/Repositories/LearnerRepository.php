<?php

namespace App\Repositories;

use App\Models\Enrolment;
use App\Repositories\Interfaces\EnrolmentRepositoryInterface;
use Illuminate\Support\Collection;

class EnrolmentRepository implements EnrolmentRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllWithRelations(): Collection
    {
        return Enrolment::with(["learner", "course"])->get();
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
