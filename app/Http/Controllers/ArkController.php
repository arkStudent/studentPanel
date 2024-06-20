<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArkController extends Controller
{

    public function index(){
        return view('timetable');
    }

    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required',
            'password' => 'required'
        ]);
        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);           
        }    
        $data = $validatedData->validated();    
        // Attempt to find the user by id
        $user = DB::table('ark_student_info')
                    ->where('student_id', $data['student_id'])
                    ->orWhere('sts_id', $data['student_id'])
                    ->first();
        if ($user) {
            if ($data['password'] === $user->password) {
                // session(['student_id' => $user->student_id, 'name' => $user->name]);
                session(['user' => (array) $user]);
                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 201);
            } else {
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else {
            return response()->json(['error' => 'User not found with provided id'], 422);
        }
    }
}

