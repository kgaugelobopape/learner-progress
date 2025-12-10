<?php

namespace App\Providers;

use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\LearnerRepositoryInterface;
use App\Repositories\LearnerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(LearnerRepositoryInterface::class, LearnerRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
