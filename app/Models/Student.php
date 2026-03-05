<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'student_id'];

    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('grade');
    }
}
