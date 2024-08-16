<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lot;
use DB;
use Auth;

class LotController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.lot.Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'area_id' => 'required'
            ]);
            $data = $request->all();
            $lot= Lot::create($data);
            addLogs('create lot named '.$request->name,Auth::user()->id);
            $lots = DB::table('lots')
            ->join('areas','lots.area_id','=','areas.id')
             ->select('lots.id as id','lots.name as name','areas.name as area_name')
            ->get();
           
            return redirect()->route('lot.list')->with(['lots' => $lots, 'success' => 'You Create  Lot Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $lot = Lot::find($id);
        addLogs('delete Lot named '.$lot->name,Auth::user()->id);
        $lot->delete();
        return redirect()->back()->with('success', 'You Delete lot Successfully');
    }

    public function index()
    {
        $lots = DB::table('lots')
            ->join('areas','lots.area_id','=','areas.id')
             ->select('lots.id as id','lots.name as name','areas.name as area_name')
            ->get();
        return view('dashboard.lot.list', ['lots' => $lots]);
    }
    
    public function edit(Request $request, $id)
    {
        $lot = DB::table('lots')->where('id', $id)->first();
       
        return view('dashboard.lot.edit', ['lot' => $lot]);
    }

    public function update(Request $request, $id)
    {
      
        try {
            

            $request->validate([
                'name' => 'required|string|max:255',
               
            ]);
            $data = $request->all();
            $lot = Lot::find($id);
            addLogs('update lot named '.$lot->name,Auth::user()->id);
            $lot->fill($data)->save();
            $lot = DB::table('lots')->get();
            return redirect()->route('lot.list')->with(['area' => $lot, 'success' => 'You update  lot successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}