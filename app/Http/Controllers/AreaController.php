<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use DB;
use Auth;

class AreaController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.Area.Create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $area = Area::create($data);
            addLogs('create area named '.$request->name,Auth::user()->id);

            $area = DB::table('areas')->get();
            return redirect()->route('area.list')->with(['area' => $area, 'success' => 'You create an area successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $area = Area::find($id);
        addLogs('delete area named '.$area->name,Auth::user()->id);
        $area->delete();
        return redirect()->back()->with('success', 'You Delete Area Successfully');
    }

    public function index()
    {
        $area = DB::table('areas')->get();
        return view('dashboard.Area.list', ['area' => $area]);
    }
    public function edit(Request $request, $id)
    {
        $area = DB::table('areas')->where('id', $id)->first();
        return view('dashboard.Area.edit', ['area' => $area]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $area = Area::find($id);
            addLogs('update area named '.$area->name,Auth::user()->id);
            $area->fill($data)->save();
            $area = DB::table('areas')->get();
            return redirect()->route('area.list')->with(['area' => $area, 'success' => 'You update an area successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}