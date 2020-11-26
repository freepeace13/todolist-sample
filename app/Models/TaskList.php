<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TaskList extends Model
{
    protected $fillable = [
        'schedule'
    ];

    protected $dates = [
        'schedule',
    ];

    public function complete()
    {
        return $this->tasks->each->complete();
    }

    public function isCompleted()
    {
        return count($this->tasks) > 0 && $this->tasks->every(function ($value) {
            return $value->completed;
        });
    }

    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = is_string($value)
            ? Carbon::createFromFormat('m-d-Y', $value)
            : $value;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_list_id');
    }

    public function scopeWhereScheduledOn(Builder $query, $schedule)
    {
        if (is_string($schedule)) {
            $schedule = Carbon::createFromFormat('m-d-Y', $schedule);
        }

        return $query->whereDate('schedule', $schedule->toDateString());
    }
}
