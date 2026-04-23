<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function listingSubject()
    {
        $subjects = SubjectModel::all();
        return response()->json($subjects);
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
        return response()->json($subject, 201);
    }

    public function detailSubject($id)
    {
        $subject = SubjectModel::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }
        return response()->json($subject);
    }

    public function updateSubject(Request $request, $id)
    {
        $subject = SubjectModel::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }

        $request->validate([
            'sub_code' => 'required|unique:subject,sub_code,' . $id . ',sub_id',
            'sub_name' => 'required',
            'lecturer_id' => 'required',
        ]);

        $subject->update([
            'sub_code' => $request->sub_code,
            'sub_name' => $request->sub_name,
            'lecturer_id' => $request->lecturer_id,
        ]);
        return response()->json($subject);
    }

    public function deleteSubject($id)
    {
        $subject = SubjectModel::find($id);
        if (!$subject) {
            return response()->json(['message' => 'Subject not found'], 404);
        }
        $subject->delete();
        return response()->json(['message' => 'Subject deleted']);
    }
}
