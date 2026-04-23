<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = "subject";

    protected $fillable = [
        'sub_code',
        'sub_name',
        'lecturer_id',
    ];

    public function class()
    {
        return $this->hasMany(ClassModel::class);
    }
}
