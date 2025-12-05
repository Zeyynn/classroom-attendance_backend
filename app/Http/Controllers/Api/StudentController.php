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
        $students = \App\Models\Student::with('classroom')->get();

        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|unique:students',
            'student_phone' => 'nullable|string|max:255',
            'classroom_id' => 'nullable|exists:classrooms,id'
        ]);

        $student = \App\Models\Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully',
            'data' => $student->load('classroom')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = \App\Models\Student::with('classroom')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = \App\Models\Student::with('classroom')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        } 

        $validated = $request->validate([
            'student_name' => 'sometimes|required|string|max:255',
            'student_email' => 'sometimes|required|email|unique:students,student_email,' . $id,
            'student_phone' => 'sometimes|nullable|string|max:255',
            'classroom_id' => 'sometimes|nullable|exists:classrooms,id'
        ]);

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $student->load('classroom')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = \App\Models\Student::with('classroom')->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
