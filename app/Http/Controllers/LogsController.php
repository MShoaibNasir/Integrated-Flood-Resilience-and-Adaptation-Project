<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class LogsController extends Controller
{
    public function index(Request $request){
        $logs=DB::table('logs')
        ->join('users','logs.user_id','=','users.id')
        ->select('users.name as name','logs.id as id','logs.activity as activity')
        ->orderBy('id','desc')
        ->get();
    
        return view('dashboard.logs.index',['logs'=>$logs]);
    }
    public function delete(Request $request,$id){
         $log=DB::table('logs')->where('id',$id)->first();
         addLogs('delete log  named ' . $log->activity, Auth::user()->id);
         $log=DB::table('logs')->where('id',$id)->delete();
         return redirect()->back()->with('success', 'You Delete Log  Successfully');

    }
}
