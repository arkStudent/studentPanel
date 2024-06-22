<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArkController extends Controller
{

    public function index()
    {
        $standard = session()->get('std');
        $division = session()->get('dv');

        $timetable = DB::table('ark_timetable')
                    ->where('standard', $standard)
                    ->where('dv', $division)
                    // ->get();
                    ->paginate(50);

        return view('timetable', compact('timetable'));
    }

    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required',
            'password' => 'required'
        ]);

        if ($validatedData->fails()) {
            Log::error('Validation errors:', $validatedData->errors()->all());
            return response()->json($validatedData->errors(), 422);
        }

        $data = $validatedData->validated();

        $user = DB::table('ark_student_info')
            ->where('student_id', $data['student_id'])
            ->orWhere('sts_id', $data['student_id'])
            ->first();

        if ($user) {
            if ($data['password'] === $user->password) {
                session(['student_id' => $user->student_id, 'name' => $user->name]);

                $additionalData = DB::table('ark_students')
                    ->where('student_id', $data['student_id'])
                    ->first();

                session([
                    'std' => $additionalData ? $additionalData->class : null,
                    'dv' => $additionalData ? $additionalData->division : null
                ]);

                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 201);
            } else{
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else{
            return response()->json(['error' => 'User not found with provided id'], 422);
        }
    }

}