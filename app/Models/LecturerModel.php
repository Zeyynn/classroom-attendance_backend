<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LecturerModel extends Model
{
    protected $table = "lecturer";

    protected $primaryKey = "lecturer_id";

    protected $fillable = [
        'user_id',
        'lecturer_name',
        'department',
    ];

    public function class()
    {
        return $this->hasMany(ClassModel::class);
    }
}
