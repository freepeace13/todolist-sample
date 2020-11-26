<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'completed' => 'boolean'
    ];

    protected $fillable = ['title', 'completed'];

    public function complete()
    {
        return $this->fill(['completed' => true])->save();
    }
}
