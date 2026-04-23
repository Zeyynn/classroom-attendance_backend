<?php

namespace App\Http\Controllers;

use app\Http\Requests\StudentRequest;
use app\Models\StudentModel as Student;
class StudentController extends Controller
{
    public function indexStudent(StudentRequest $request)
    {
        $students = Student::all();
        return response()->json([
            'students' => $students,
            'message' => 'Students retrieved successfully'
        ]);
    }

    public function showStudent(StudentRequest $request, $student_id)
    {
        $student = Student::find($student_id);
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

    public function createStudent(StudentRequest $request)
    {
        Student::create([
            'student_name' => $request->name,
            'student_email' => $request->email,
            'matric_no' => $request->matric_no,
        ]);
        return response()->json([
            'message' => 'Student created successfully'
        ]);
    }

    public function updateStudent (StudentRequest $request, $student_id)
    {
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
        $student->update([
            'student_name' => $request->name,
            'student_email' => $request->email,
            'matric_no' => $request->matric_no,
        ]);
        return response()->json([
            'message' => 'Student updated successfully'
        ]);
    }

    public function deleteStudent(StudentRequest $request, $student_id)
    {
        $student = Student::find($student_id);
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
