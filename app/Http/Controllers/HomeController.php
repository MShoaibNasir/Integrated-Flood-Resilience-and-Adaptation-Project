<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function filter_lot(Request $request){
         $lots=DB::table('lots')->where('area_id',$request->area)->get();
         return $lots;
    }
    public function filter_districts(Request $request){
         $districts=DB::table('districts')->where('lot_id',$request->lot_id)->get();
         return $districts;
    }
    public function filter_tehsil(Request $request){
         $tehsil=DB::table('tehsil')->where('districts_id',$request->district_id)->get();
         return $tehsil;
    }
    public function filter_uc(Request $request){
         $uc=DB::table('uc')->where('tehsil_id',$request->tehsil_id)->get();
         return $uc;
    }
}
