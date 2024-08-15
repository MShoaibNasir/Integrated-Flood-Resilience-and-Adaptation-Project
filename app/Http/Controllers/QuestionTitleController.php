<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionTitle;
use Auth;
use DB;

class QuestionTitleController extends Controller
{
    public function create(Request $requets,$id)
    {
        
        return view('dashboard.question_title.create')->with(['form_id'=>$id]);
    }

    public function store(Request $request,$id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                
            ]);
            $data = $request->all();
            $data['form_id']=$id;
            $form = QuestionTitle::create($data);
            addLogs('create Question Title named ' . $form->name, Auth::user()->id);
            $form = DB::table('question_title')
                ->get();
            return redirect()->route('form.view',[$id])->with(['form' => $form, 'success' => 'You Create  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        $form = QuestionTitle::find($id);
        addLogs('delete question title named ' . $form->name, Auth::user()->id);
        $form->delete();
        return redirect()->back()->with('success', 'You Delete Question Title Successfully');
    }

    public function index()
    {
        $form = DB::table('form')->get();
        return view('dashboard.question_title.list', ['form' => $form]);
    }
    public function edit(Request $request, $id)
    {
        $question_title = DB::table('question_title')->where('id', $id)->first();
        return view('dashboard.question_title.edit', ['question_title' => $question_title]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $question_title = QuestionTitle::find($id);
            addLogs('update Question title named ' . $question_title->name, Auth::user()->id);
            $question_title->fill($data)->save();
            $question_titles = DB::table('question_title')
                ->get();
            return redirect()->route('form.view',[$request->form_id])->with(['form' => $question_titles, 'success' => 'You Create  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function view(Request $request, $id){
       $question_titles=DB::table('question_title')->where('form_id',$id)->get();
       return view('dashboard.question_title.list')->with(['question_titles'=>$question_titles]);
    }
    public function show(Request $request, $id)
    {
        $question_title = DB::table('question_title')->where('id', $id)->first();
        return view('dashboard.question_title.show', ['question_title' => $question_title]);
    }
}
