<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Auth;
use DB;
class RoleController extends Controller
{
    public function index(Request $request)
    {
        $role = Role::select('id', 'name')->get();
        return view('dashboard.role.list', ['role' => $role]);
    }

    public function create(Request $requets)
    {
        return view('dashboard.role.Create');
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required|max:255',
            ]);
            $role = Role::create([
                'name' => $request->name,
            ]);
            addLogs('create role named ' . $role->name, Auth::user()->id);


            $role = Role::select('id', 'name')->get();
            return redirect()->route('role.list')->with(['role' => $role, 'success' => 'You Create  Role Successfully!']);
       
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }

    public function delete(Request $request, $id)
    {
        $role = Role::find($id);
        addLogs('delete Role named '.$role->name,Auth::user()->id);
        $role->delete();
        return redirect()->back()->with('success', 'You Delete role Successfully');
    }



    public function edit(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        return view('dashboard.role.edit', ['role' => $role]);
    }

    public function update(Request $request, $id)
    {
      
        try {
            

            $request->validate([
                'name' => 'required|string|max:255',
               
            ]);
            $data = $request->all();
            $role = Role::find($id);
            addLogs('update role named '.$role->name,Auth::user()->id);
            $role->fill($data)->save();
            $role = Role::select('id', 'name')->get();
            return redirect()->route('role.list')->with(['role' => $role, 'success' => 'You Create  Role Successfully!']);
       
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
}
