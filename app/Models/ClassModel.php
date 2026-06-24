<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = "class";

    protected $primaryKey = "class_id";

    protected $fillable = [
        'subject_id',
        'lecturer_id',
        'class_name',
        'date',
        'location',
    ];

    public function student()
    {
        return $this->hasMany(StudentModel::class);
    }
}
