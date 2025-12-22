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
        return $courseName
            ? $this->learnerRepository->getByCourseName($courseName, $sortBy)
            : $this->learnerRepository->getAll($sortBy);
    }
}
