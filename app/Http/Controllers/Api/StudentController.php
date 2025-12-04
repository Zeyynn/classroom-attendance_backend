<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignStudent(Classroom $classroom, Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $classroom->students()->syncWithoutDetaching($request->student_id);

        return response()->json([
            'message' => 'Student assigned successfully',
            'data' => $classroom->students
        ]);
    }

    public function removeStudent(Classroom $classroom, Student $student)
    {
        $classroom->students()->detach($student->id);

        return response()->json(['message' => 'Student removed']);
    }
}
