<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'student_email', 'student_phone'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
