<?php

namespace App\Repositories;

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
        return Learner::with(["courses"])->get();
    }

    /**
     * @param string $courseName
     * @return Collection
     */
    public function getByCourseName(string $courseName): Collection
    {
        return Learner::with(["courses"])
            ->whereHas("courses", function ($query) use ($courseName) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($courseName).'%']);
            })
            ->get();
    }
}
