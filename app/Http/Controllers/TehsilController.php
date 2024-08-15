<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tehsil;
use DB;
use Auth;

class TehsilController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.tehsil.Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'districts_id' => 'required'
            ]);
            $data = $request->all();
           

            $tehsil = Tehsil::create($data);
           
            addLogs('create tehsil named'.$request->name,Auth::user()->id);
            $tehsil = DB::table('tehsil')
                ->join('districts', 'tehsil.districts_id', '=', 'districts.id')
                ->select('tehsil.id as id', 'tehsil.name as name', 'districts.name as district_name')
                ->get();
                

            return redirect()->route('tehsil.list')->with(['district' => $tehsil, 'success' => 'You Create  Tehsil Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $tehsil = Tehsil::find($id);
        addLogs('delete tehsil named'.$tehsil->name,Auth::user()->id);
        $tehsil->delete();
        return redirect()->back()->with('success', 'You Delete tehsil Successfully');
    }

    public function index()
    {
        $tehsil = DB::table('tehsil')
            ->join('districts', 'tehsil.districts_id', '=', 'districts.id')
            ->select('tehsil.id as id', 'tehsil.name as name', 'districts.name as district_name')
            ->get();
        return view('dashboard.tehsil.list', ['tehsil' => $tehsil]);
    }
    public function edit(Request $request, $id)
    {
        $tehsil = DB::table('tehsil')->where('id', $id)->first();
        $district=DB::table('districts')->get();
        return view('dashboard.tehsil.edit', ['tehsil' => $tehsil,'district'=>$district]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'districts_id' => 'required'
            ]);
            $data = $request->all();
            $tehsil = Tehsil::find($id);
            addLogs('update tehsil named'.$tehsil->name,Auth::user()->id);
            $tehsil->fill($data)->save();
            $tehsil = DB::table('tehsil')
                ->join('districts', 'tehsil.districts_id', '=', 'districts.id')
                ->select('tehsil.id as id', 'tehsil.name as name', 'districts.name as district_name')
                ->get();
            return redirect()->route('tehsil.list')->with(['tehsil' => $tehsil, 'success' => 'You update  tehsil successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}