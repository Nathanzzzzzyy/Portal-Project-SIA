<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'title', 'units', 'schedule_day', 'schedule_time', 'room'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}