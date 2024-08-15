<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use DB;
use Auth;

class DistrictController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.district.Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'lot_id' => 'required'
            ]);
            $data = $request->all();

            $district = District::create($data);
            addLogs('create district named '.$district->name,Auth::user()->id);
            $district = DB::table('districts')
                ->join('lots', 'districts.lot_id', '=', 'lots.id')
                ->select('districts.id as id', 'districts.name as name', 'lots.name as lot_name')
                ->get();

            return redirect()->route('district.list')->with(['district' => $district, 'success' => 'You Create  District Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $district = District::find($id);
        addLogs('delete district named '.$district->name,Auth::user()->id);
        $district->delete();
        return redirect()->back()->with('success', 'You Delete District Successfully');
    }

    public function index()
    {
        $district = DB::table('districts')
            ->join('lots', 'districts.lot_id', '=', 'lots.id')
            ->select('districts.id as id', 'districts.name as name', 'lots.name as lot_name')
            ->get();
        return view('dashboard.district.list', ['district' => $district]);
    }
    public function edit(Request $request, $id)
    {
        $district = DB::table('districts')->where('id', $id)->first();
        return view('dashboard.district.edit', ['district' => $district]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'lot_id' => 'required'
            ]);
            $data = $request->all();
            $district = District::find($id);
            addLogs('update district named '.$district->name,Auth::user()->id);
            $district->fill($data)->save();
            $district = DB::table('districts')
            ->join('lots', 'districts.lot_id', '=', 'lots.id')
            ->select('districts.id as id', 'districts.name as name', 'lots.name as lot_name')
            ->get();

        return redirect()->route('district.list')->with(['district' => $district, 'success' => 'You Update  District Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}