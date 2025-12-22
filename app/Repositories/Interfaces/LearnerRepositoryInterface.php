<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface LearnerRepositoryInterface
{
    public function getAll(string $sortBy = null): Collection;

    public function getByCourseName(string $courseName, string $sortBy): Collection;
}
