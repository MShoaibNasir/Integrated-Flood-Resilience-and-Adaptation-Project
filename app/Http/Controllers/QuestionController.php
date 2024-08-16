<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Question;
use App\Models\Option;

class QuestionController extends Controller
{
    public function create(Request $requets, $id)
    {
        $Option = Option::where('section_id', $id)->get();
        $question = Question::where('section_id', $id)->get();
        $section = DB::table('question_title')->where('id', $id)
            ->select('name', 'form_id')
            ->first();
        $form_name = DB::table('form')->where('id', $section->form_id)
            ->select('name')
            ->first();



        return view('dashboard.question.Create')->with(['title_id' => $id, 'Option' => $Option, 'question' => $question, 'section' => $section, 'form_name' => $form_name]);
    }
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'section_id' => 'required',

            ]);
            $data = $request->all();
            $question = Question::create($data);
            addLogs('create Question named ' . $question->name, Auth::user()->id);
            // $questions = DB::table('question_one')
            // ->where('question_title_id',$request->question_title_id)
            //     ->get();
            
            $question = DB::table('questions')
            ->where('section_id', $request->section_id)->get();
            return redirect()->route('question.list', [$request->section_id])->with(['question' => $question , 'success' => 'You Create  Question Successfully!']);
          
            // return redirect()->back()->with(['success' => 'You Create  Question Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $question = Question::find($id);
            $options = Option::where('question_id', $question->id)->get();
            foreach ($options as $option) {
                $inner_questions = Question::where('option_id', $option->id)->get();
                foreach ($inner_questions as $item) {
                    addLogs('delete question  named ' . $item->name, Auth::user()->id);
                    $item->delete();
                }
                addLogs('delete option  named ' . $option->name, Auth::user()->id);
                $option->delete();
            }
            addLogs('delete question  named ' . $question->name, Auth::user()->id);
            $question->delete();
            DB::commit();
            return redirect()->back()->with('success', 'You Delete Question Successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
        }

    }
    public function index(Request $request, $id)
    {
        $question = DB::table('questions')
            ->where('section_id', $id)->get();
        return view('dashboard.question.list', ['question' => $question, 'title_id' => $id]);
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
            return redirect()->route('form.view', [$request->form_id])->with(['form' => $question_titles, 'success' => 'You Create  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }
    public function view(Request $request, $id)
    {
        $question_titles = DB::table('question_title')->where('form_id', $id)->get();
        return view('dashboard.question_title.list')->with(['question_titles' => $question_titles]);
    }
    public function show(Request $request, $id)
    {
        $question_title = DB::table('question_title')->where('id', $id)->first();
        return view('dashboard.question_title.show', ['question_title' => $question_title]);
    }

    public function question_filter(Request $request)
    {

        try {
            $question = DB::table('questions')->where('id', $request->question_id)
                ->select('name')
                ->first();
            return $question;
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function related_question(Request $request){
          $option=DB::table('options')->where('id',$request->option_id)->first();
          $question=DB::table('questions')->where('id',$option->question_id)->first();
          return $question;

    }


}
