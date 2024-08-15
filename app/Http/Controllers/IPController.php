<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;

class IPController extends Controller
{
    public function create()
    {
        $areas = DB::table('areas')->get();
        return view('IP.create', ['areas' => $areas]);
    }
    public function index()
    {
        $data = User::where('role', 2)
            ->join('areas', 'users.area_id', '=', 'areas.id')
            ->join('districts', 'users.district_id', '=', 'districts.id')
            ->join('lots', 'users.lot_id', '=', 'lots.id')
            ->join('tehsil', 'users.tehsil_id', '=', 'tehsil.id')
            ->join('uc', 'users.uc_id', '=', 'uc.id')
            ->select(
                'users.name as username',
                'users.email as user_email',
                'areas.name as area_name',
                'districts.name as district_name',
                'lots.name as lot_name',
                'tehsil.name as tehsil_name',
                'uc.name as uc_name',
                'users.created_at as date_of_registeration',
                'users.id as id',
                'users.status as status',
            )
            ->get();



        return view('IP.index', compact('data'));
    }
    public function ip_signup(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'area_id' => 'required',
                'lot_id' => 'required',
                'district_id' => 'required',
                'tehsil_id' => 'required',
                'uc_id' => 'required',
                'password' => 'required|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = '_image' . time() . '.' . $extension;
                $image->move(public_path('admin/assets/img'), $filename);
                $data['image'] = $filename;
            }
            addLogs('Create Implementation  partner' . $request->name, Auth::user()->id);
            $user = User::create($data);
            return redirect()->back()->with('success', 'You register a Implementation Partner Successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }


    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        addLogs('Delete Implementation partner named ' . $user->name, Auth::user()->id);
        $user->delete();
        return redirect()->back()->with('success', 'You Delete Implementation Partner Successfully');
    }

    public function block(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->status == 1) {
            $user->status = '0';
            $user->save();
            addLogs('block Implementation partner named ' . $user->name, Auth::user()->id);
            return redirect()->back()->with('success', 'You Block Implementation Partner Successfully');
        } else {
            $user->status = '1';
            $user->save();
            return redirect()->back()->with('success', 'You Unblock Implementation Partner Successfully');
        }


    }

}
