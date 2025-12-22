<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "firstname",
        "lastname",
    ];

    /**
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, "enrolments")->withPivot("progress");
    }

    public function getFullNameAttribute(): string {
        return $this->firstname. " ".$this->lastname;
    }

    /**
     * @return HasMany
     */
    public function enrolments(): HasMany
    {
        return $this->hasMany(Enrolment::class);
    }
}
