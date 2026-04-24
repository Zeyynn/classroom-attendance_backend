<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function listingSubject()
    {
        $subjects = SubjectModel::all();
        return response()->json([
            'message' => 'Subjects retrieved successfully',
            'subjects' => $subjects
        ]);
    }

    public function createSubject(Request $request)
    {
        $request->validate([
            'sub_code' => 'required|unique:subject,sub_code',
            'sub_name' => 'required',
            'lecturer_id' => 'required',
        ]);

        $subject = SubjectModel::create([
            'sub_code' => $request->sub_code,
            'sub_name' => $request->sub_name,
            'lecturer_id' => $request->lecturer_id,
        ]);
        return response()->json([
            'message' => 'Subject created successfully',
            'subject' => $subject
        ], 201);
    }

    public function detailSubject($sub_id)
    {
        $subject = SubjectModel::find($sub_id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }
        return response()->json([
            'message' => 'Subject retrieved successfully',
            'subject' => $subject
        ]);
    }

    public function updateSubject(Request $request, $sub_id)
    {
        $subject = SubjectModel::find($sub_id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $request->validate([
            'sub_code' => 'required|unique:subject,sub_code,' . $sub_id . ',sub_id',
            'sub_name' => 'required',
            'lecturer_id' => 'required',
        ]);

        $subject->update([
            'sub_code' => $request->sub_code ?? $subject->sub_code,
            'sub_name' => $request->sub_name ?? $subject->sub_name,
            'lecturer_id' => $request->lecturer_id ?? $subject->lecturer_id,
        ]);
        return response()->json([
            'message' => 'Subject updated successfully',
            'subject' => $subject
        ]);
    }

    public function deleteSubject($sub_id)
    {
        $subject = SubjectModel::find($sub_id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }
        $subject->delete();
        return response()->json(['message' => 'Subject deleted']);
    }
}
