<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Option;
use App\Models\Question;

class OptionsController extends Controller
{
    public function index(Request $request, $id)
    {
        $options = DB::table('options')
            ->where('section_id', $id)->get();
        return view('dashboard.options.list', ['options' => $options, 'title_id' => $id]);
    }



    public function store(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required|max:255',
                'type' => 'required|max:255',
                'section_id' => 'required',
                'question_id' => 'required',

            ]);
            $count_options_by_name = count($request->name);
            for ($i = 0; $i < $count_options_by_name; $i++) {
                $options = Option::create([
                    'name' => $request->name[$i],
                    'question_id' => $request->question_id,
                    'type' => $request->type[$i],
                    'section_id' => $request->section_id,
                ]);
                addLogs('create option named ' . $options->name[$i], Auth::user()->id);
            }

            $question = DB::table('questions')
            ->where('section_id', $request->section_id)->get();
            return redirect()->route('question.list', [$request->section_id])->with(['question' => $question , 'success' => 'You Create  Option Successfully!']);
          

            // $questions = DB::table('question_one')
            // ->where('question_title_id',$request->question_title_id)
            //     ->get();
            // return redirect()->route('question.list', [$request->question_title_id])->with(['question' => $questions , 'success' => 'You Create  Question Successfully!']);
            // return redirect()->back()->with(['success' => 'You Create  Option data Successfully!']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }

    public function delete(Request $request, $id)
    {
        $options = Option::where('id', $id)->first();
        $question = Question::where('option_id', $options->id)->get();
        foreach ($question as $ques) {
            $inner_options = Option::where('id', $ques->option_id)->get();
            foreach ($inner_options as $item) {
                addLogs('delete option  named ' . $options->name, Auth::user()->id);
                $item->delete();
            }
            addLogs('delete question  named ' . $ques->name, Auth::user()->id);
            $ques->delete();
        }

        addLogs('delete option  named ' . $options->name, Auth::user()->id);
        $options->delete();
        return redirect()->back()->with('success', 'You Delete Option Successfully');
    }




    public function edit(Request $request, $id, $title_id)
    {
        $question = Question::where('section_id', $title_id)->get();
        $options = DB::table('options')->where('id', $id)->first();
        return view('dashboard.options.edit', ['options' => $options, 'title_id' => $title_id,'question'=>$question]);
    }
    public function update(Request $request, $id, $title_id)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $data = $request->all();
            $option = Option::find($id);
            addLogs('update Option  named ' . $option->name, Auth::user()->id);
            $option->fill($data)->save();
            $options = DB::table('options')
                ->where('section_id', $id)->get();
            return redirect()->route('options.list', [$title_id])->with(['options' => $options, 'success' => 'You Create  Form Successfully!']);

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }


    }

    public function option_filter(Request $request)
    {

        try {
            $option = DB::table('options')->where('id', $request->option_id)
                ->select('name')
                ->first();
            return $option;
        } catch (\Throwable $th) {
            return $th;
        }

    }
}
