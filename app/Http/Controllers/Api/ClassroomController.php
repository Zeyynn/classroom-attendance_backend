<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = \App\Models\Classroom::with('students')->get();

        return response()->json([
            'success' => true,
            'data' => $classrooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_name' => 'required|string|max:255',
            'classroom_description' => 'nullable|string'
        ]);

        $classroom = \App\Models\Classroom::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Classroom created successfully',
            'data' => $classroom
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = \App\Models\Classroom::with('students')->find($id);

        if (!$classroom) {
            return response()->json([
                'success' => false,
                'message' => 'Classroom not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classroom = \App\Models\Classroom::find($id);

        if (!$classroom) {
            return response()->json([
                'success' => false,
                'message' => 'Classroom not found'
            ], 404);
        }

        $validated = $request->validate([
            'classroom_name' => 'sometimes|required|string|max:255',
            'classroom_description' => 'nullable|string'
        ]);

        $classroom->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Classroom updated successfully',
            'data' => $classroom
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = \App\Models\Classroom::find($id);

        if (!$classroom) {
            return response()->json([
                'success' => false,
                'message' => 'Classroom not found'
            ], 404);
        }

        $classroom->delete();

        return response()->json([
            'success' => true,
            'message' => 'Classroom deleted successfully'
        ]);
    }

    public function assignStudent(\App\Models\Classroom $classroom, Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $student = \App\Models\Student::find($validated['student_id']);

        $student->update(['classroom_id' => $classroom->id]);

        return response()->json([
            'success' => true,
            'message' => 'Student assigned to classroom successfully',
            'data' => $classroom->load('students')
        ]);
    }

    public function removeStudent(\App\Models\Classroom $classroom, \App\Models\Student $student)
    {
        if ($student->classroom_id != $classroom->id) {
            return response()->json([
                'success' => false,
                'message' => 'Student does not belong to this classroom'
            ], 400);
        }

        $student->update(['classroom_id' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Student removed from classroom successfully'
        ]);
    }
}
