<?php

use App\Http\Controllers\LearnerController;
use Illuminate\Support\Facades\Route;

Route::prefix("learners")->name('learners.')->group(function () {
    Route::get("/", [LearnerController::class, "getData"]);
});
