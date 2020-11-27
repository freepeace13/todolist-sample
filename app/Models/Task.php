<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Casts specified columns
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'completed'];

    /**
     * Mark task as completed.
     *
     * @return self
     */
    public function complete()
    {
        return $this->fill(['completed' => true])->save();
    }
}
