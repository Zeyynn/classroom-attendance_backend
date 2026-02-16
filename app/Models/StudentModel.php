<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = "student";

    protected $fillable = [
        'student_name',
        'student_email',
        'matric_no',
    ];

    public function class()
    {
        return $this->hasMany(ClassModel::class);
    }
}
