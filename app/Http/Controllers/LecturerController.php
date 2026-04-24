<?php

namespace App\Http\Controllers;

use App\Models\LecturerModel;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function listingLecturer()
    {
        $lecturers = LecturerModel::all();
        return response()->json([
            'message' => 'Lecturers retrieved successfully',
            'lecturers' => $lecturers
        ]);
    }

    public function createLecturer(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:lecturer,user_id',
            'lecturer_name' => 'required',
            'department' => 'required',
        ]);

        $lecturer = LecturerModel::create([
            'user_id' => $request->user_id,
            'lecturer_name' => $request->lecturer_name,
            'department' => $request->department,
        ]);
        return response()->json([
            'lecturer' => $lecturer,
            'message' => 'Lecturer created successfully'
        ], 201);
    }

    public function detailLecturer($id)
    {
        $lecturer = LecturerModel::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Lecturer not found'], 404);
        }
        return response()->json([
            'lecturer' => $lecturer,
            'message' => 'Lecturer retrieved successfully'
        ]);
    }

    public function updateLecturer(Request $request, $id)
    {
        $lecturer = LecturerModel::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Lecturer not found'], 404);
        }

        $request->validate([
            'user_id' => 'required|unique:lecturer,user_id,' . $id . ',lecturer_id',
            'lecturer_name' => 'required',
            'department' => 'required',
        ]);

        $lecturer->update([
            'user_id' => $request->user_id ?? $lecturer->user_id,
            'lecturer_name' => $request->lecturer_name ?? $lecturer->lecturer_name,
            'department' => $request->department ?? $lecturer->department,
        ]);
        return response()->json([
            'lecturer' => $lecturer,
            'message' => 'Lecturer updated successfully'
        ]);
    }

    public function deleteLecturer($id)
    {
        $lecturer = LecturerModel::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Lecturer not found'], 404);
        }
        $lecturer->delete();
        return response()->json([
            'message' => 'Lecturer deleted successfully'
        ]);
    }
}
