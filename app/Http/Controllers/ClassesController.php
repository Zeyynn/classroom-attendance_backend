<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        return response()->json([
            ['id' => 1, 'class_name' => 'Math 101'],
            ['id' => 2, 'class_name' => 'Physics 102'],
        ]);
    }
}
