<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Auth;
use DB;
class FormController extends Controller
{
    public function create(Request $requets)
    {
        return view('dashboard.form.Create');
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                
            ]);
            $data = $request->all();
            $form = Form::create($data);
            addLogs('create Form named ' . $form->name, Auth::user()->id);
            $form = DB::table('form')
                ->get();
            return redirect()->route('form.list')->with(['form' => $form, 'success' => 'You Create  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $form = Form::find($id);
        addLogs('delete form named ' . $form->name, Auth::user()->id);
        $form->delete();
        return redirect()->back()->with('success', 'You Delete Form Successfully');
    }

    public function index()
    {
        $form = DB::table('form')->get();
        return view('dashboard.form.list', ['form' => $form]);
    }
    public function edit(Request $request, $id)
    {
        $form = DB::table('form')->where('id', $id)->first();
        return view('dashboard.form.edit', ['form' => $form]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $form = Form::find($id);
            addLogs('update Form named ' . $form->name, Auth::user()->id);
            $form->fill($data)->save();
            $form = DB::table('form')
                ->get();
            return redirect()->route('form.list')->with(['form' => $form, 'success' => 'You Update  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function view(Request $request, $id){
       $question_titles=DB::table('question_title')->where('form_id',$id)->get();
       return view('dashboard.question_title.list')->with(['question_titles'=>$question_titles,'form_id'=>$id]);
    }
}
