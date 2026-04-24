<?php

namespace App\Http\Controllers;

use App\Models\AttendanceModel;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function listingAttendance()
    {
        $attendances = AttendanceModel::all();
        return response()->json($attendances);
    }

    public function createAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        $attendance = AttendanceModel::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'Attendance record created successfully',
            'attendance' => $attendance
        ], 201);
    }

    public function detailAttendance($id)
    {
        $attendance = AttendanceModel::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }
        return response()->json([
            'message' => 'Attendance record retrieved successfully',
            'attendance' => $attendance
        ]);
    }

    public function updateAttendance(Request $request, $id)
    {
        $attendance = AttendanceModel::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $request->validate([
            'student_id' => 'required',
            'class_id' => 'required',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        $attendance->update([
            'student_id' => $request->student_id ?? $attendance->student_id,
            'class_id' => $request->class_id ?? $attendance->class_id,
            'status' => $request->status ?? $attendance->status,
        ]);
        return response()->json([
            'message' => 'Attendance record updated successfully',
            'attendance' => $attendance
        ]);
    }

    public function deleteAttendance($id)
    {
        $attendance = AttendanceModel::find($id);
        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }
        $attendance->delete();
        return response()->json([
            'message' => 'Attendance record deleted successfully'
        ]);
    }
}
