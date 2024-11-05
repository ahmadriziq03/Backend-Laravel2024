<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return response()->json([
                'message' => 'No students found'
            ], 404);
        }

        return response()->json([
            'message' => 'Get All Student',
            'data' => $students
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'jurusan' => 'required'
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Student is created successfully',
            'data' => $student
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required',
            'nim' => 'sometimes|required|unique:students,nim,' . $student->id,
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'jurusan' => 'sometimes|required'
        ]);

        $student->update($request->all());

        return response()->json([
            'message' => 'Student is updated',
            'data' => $student
        ], 200);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student is deleted successfully'
        ], 200);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Get detail student',
            'data' => $student
        ], 200);
    }
}
