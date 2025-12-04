<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Student extends Model
{

    use HasFactory;
    protected $fillable = ['student_name', 'student_email', 'student_phone', 'classroom_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
