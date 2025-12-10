<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class CourseRepository implements CourseRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Course::all();
    }
}
