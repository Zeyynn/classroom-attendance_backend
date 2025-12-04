<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['classroom_name', 'classroom_description'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
