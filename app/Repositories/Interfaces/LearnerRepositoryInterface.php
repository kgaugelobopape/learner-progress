<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface EnrolmentRepositoryInterface
{
    public function getAllWithRelations(): Collection;
    public function getByCourseName(string $courseName): Collection;
    public function getAllCourseNames(): Collection;
}
