<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface LearnerRepositoryInterface
{
    public function getAll(): Collection;
    public function getByCourseName(string $courseName): Collection;
}
