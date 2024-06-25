<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


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

    // change password function
    public function changePass(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required'
        ]);
        $student_id = Session::get('student_id');
        $user = DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->first();
        if ($request->old_pass !== $user->password) {
            return response()->json(['error' => 'Incorrect old password'], 400);
        }
        if ($request->old_pass === $request->new_pass) {
            return response()->json(['error' => 'Old and new passwords cannot be the same'], 400);
        }
        DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->update(['password' => $request->new_pass]);
        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    // forgot password function
    public function forgotPass(Request $request)
    {
        $request->validate([
            'pass' => 'required',
            'cpass' => 'required'
        ]);
        $student_id = Session::get('student_id');
        $user = DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->first();
        if ($user->password === $request->pass) {
            return response()->json(['error' => 'Old password is same as new password'], 400);
        }
        if ($request->pass !== $request->cpass) {
            return response()->json(['error' => 'Password and confirm password does not match'], 400);
        }
        DB::table('ark_student_info')
            ->where('student_id', $student_id)
            ->update(['password' => $request->pass]);
        return response()->json(['message' => 'Password set successfully'], 200);
    }


}