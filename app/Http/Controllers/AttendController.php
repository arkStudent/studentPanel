<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    $attendance = DB::table('ark_attend')
        ->where('student_id', $student_id)
        ->where('std', $std)
        ->where('dv', $dv)
        ->whereBetween('date', [$fdate, $tdate])
        ->get();

    if ($request->ajax()) {
        return response()->json($attendance);
    } else {
        return view('attendTable', compact('attendance'));
    }
}

}
