<?php

namespace App\Services;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class CourseService
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->courseRepository->getAll();
    }
}
