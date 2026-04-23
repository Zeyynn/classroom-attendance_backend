<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests\ClassroomRequest;
use App\Models\ClassModel;

class ClassroomController extends Controller
{
    public function indexClassroom(ClassroomRequest $request)
    {
        $classrooms = ClassModel::all();
        return response()->json([
            'classrooms' => $classrooms,
            'message' => 'Classrooms retrieved successfully'
        ]);
    }

    public function showClassroom(ClassroomRequest $request, $class_id)
    {
        $classroom = ClassModel::find($class_id);
        if (!$classroom) {
            return response()->json([
                'message' => 'Classroom not found'
            ], 404);
        }
        return response()->json([
            'classroom' => $classroom,
            'message' => 'Classroom retrieved successfully'
        ]);
    }

    public function createClassroom(ClassroomRequest $request)
    {
        ClassModel::create([
            'subject_id' => $request->subject_id,
            'lecturer_id' => $request->lecturer_id,
            'class_name' => $request->class_name,
            'date' => $request->date,
            'location' => $request->location,
        ]);
        return response()->json([
            'message' => 'Classroom created successfully'
        ]);
    }

    public function updateClassroom(ClassroomRequest $request, $class_id)
    {
        $classroom = ClassModel::find($class_id);
        if (!$classroom) {
            return response()->json([
                'message' => 'Classroom not found'
            ], 404);
        }
        $classroom->update([
            'subject_id' => $request->subject_id,
            'lecturer_id' => $request->lecturer_id,
            'class_name' => $request->class_name,
            'date' => $request->date,
            'location' => $request->location,
        ]);
        return response()->json([
            'message' => 'Classroom updated successfully'
        ]);
    }

    public function deleteClassroom(ClassroomRequest $request, $class_id)
    {
        $classroom = ClassModel::find($class_id);
        if (!$classroom) {
            return response()->json([
                'message' => 'Classroom not found'
            ], 404);
        }
        $classroom->delete();
        return response()->json([
            'message' => 'Classroom deleted successfully'
        ]);
    }
}
