<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests\ClassroomRequest;
use App\Models\ClassModel;

class ClassroomController extends Controller
{
    public function listingClassroom()
    {
        $classrooms = ClassModel::all();
        return response()->json([
            'message' => 'Classrooms retrieved successfully',
            'classrooms' => $classrooms
        ]);
    }

    public function detailClassroom($class_id)
    {
        $classroom = ClassModel::find($class_id);
        if (!$classroom) {
            return response()->json([
                'message' => 'Classroom not found'
            ], 404);
        }
        return response()->json([
            'message' => 'Classroom retrieved successfully',
            'classroom' => $classroom
        ]);
    }

    public function createClassroom(Request $request)
    {
        $classroom =ClassModel::create([
            'subject_id' => $request->subject_id,
            'lecturer_id' => $request->lecturer_id,
            'class_name' => $request->class_name,
            'date' => $request->date,
            'location' => $request->location,
        ]);
        return response()->json([
            'message' => 'Classroom created successfully',
            'classroom' => $classroom
        ]);
    }

    public function updateClassroom(Request $request, $class_id)
    {
        $classroom = ClassModel::find($class_id);
        if (!$classroom) {
            return response()->json([
                'message' => 'Classroom not found'
            ], 404);
        }
        $classroom->update([
            'subject_id' => $request->subject_id ?? $classroom->subject_id,
            'lecturer_id' => $request->lecturer_id ?? $classroom->lecturer_id,
            'class_name' => $request->class_name ?? $classroom->class_name,
            'date' => $request->date ?? $classroom->date,
            'location' => $request->location ?? $classroom->location,
        ]);
        return response()->json([
            'message' => 'Classroom updated successfully',
            'classroom' => $classroom
        ]);
    }

    public function deleteClassroom(Request $request, $class_id)
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
