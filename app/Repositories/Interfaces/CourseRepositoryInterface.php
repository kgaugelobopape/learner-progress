<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function getAll(): Collection;
}
