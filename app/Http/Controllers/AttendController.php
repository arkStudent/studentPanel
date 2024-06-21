<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendController extends Controller
{
    public function index(){

        return view('attendance');
    }

    public function showAttendance(Request $request)
    {
        $request->validate([
            'fdate' => 'required|date',
            'tdate' => 'required|date|after_or_equal:fdate',
        ]);

        $fdate = $request->input('fdate');
        $tdate = $request->input('tdate');
        $student_id = Session::get('student_id');
        $std = Session::get('std');
        $dv = Session::get('dv');

        $attendance = DB::table('attendance')
            ->where('student_id', $student_id)
            ->where('std', $std)
            ->where('dv', $dv)
            ->whereBetween('date', [$fdate, $tdate])
            ->get();

        return response()->json($attendance);
    }
}
