<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TaskGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule'
    ];

    /**
     * Specify the timestamp
     *
     * @var array
     */
    protected $dates = [
        'schedule',
    ];

    /**
     * Mark the group and it's tasks as completed.
     *
     * @return self
     */
    public function complete()
    {
        return $this->tasks->each->complete();
    }

    /**
     * Determine the group was completed.
     *
     * @return boolean
     */
    public function isCompleted()
    {
        return count($this->tasks) > 0 && $this->tasks->every(function ($value) {
            return $value->completed;
        });
    }

    /**
     * Set the schedule attribute
     *
     * @param mixed
     */
    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = is_string($value)
            ? Carbon::createFromFormat('m-d-Y', $value)
            : $value;
    }

    /**
     * Get the group tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'group_id');
    }

    /**
     * Scope a query that only include groups scheduled with the given date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $schedule
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDated(Builder $query, $schedule)
    {
        if (is_string($schedule)) {
            $schedule = Carbon::createFromFormat('m-d-Y', $schedule);
        }

        return $query->whereDate('schedule', $schedule->toDateString());
    }
}
