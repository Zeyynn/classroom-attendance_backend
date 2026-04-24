<?php

namespace App\Http\Controllers;

use app\Http\Requests\StudentRequest;
use App\Models\StudentModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function listingStudent(Request $request)
    {
        $students = StudentModel::all();
        return response()->json([
            'students' => $students,
            'message' => 'Students retrieved successfully'
        ]);
    }

    public function detailStudent($student_id)
    {
        $student = StudentModel::find($student_id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        return response()->json([
            'student' => $student,
            'message' => 'Student retrieved successfully'
        ]);
    }

    public function createStudent(Request $request)
    {
        $student = StudentModel::create([
            'student_name' => $request->name,
            'student_email' => $request->email,
            'matric_no' => $request->matric_no,
        ]);
        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    public function updateStudent(Request $request, $student_id)
    {
        $student = StudentModel::find($student_id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        $student->update([
            'student_name' => $request->name ?? $student->student_name,
            'student_email' => $request->email ?? $student->student_email,
            'matric_no' => $request->matric_no ?? $student->matric_no,
        ]);
        return response()->json([
            'message' => 'Student updated successfully',
            'student' => $student
        ]);
    }

    public function deleteStudent(Request $request, $student_id)
    {
        $student = StudentModel::find($student_id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        $student->delete();
        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}
