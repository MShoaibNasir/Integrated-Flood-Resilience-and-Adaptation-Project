<?php

namespace App\Http\Controllers\API;



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class SurveyController extends BaseController
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User register successfully.');
    }


    // public function survey_form(Request $request)
    // {

    //     $form_data = DB::table('form')->get();

    //     $questions = [];
    //     foreach ($form_data as $form) {
    //         $form_id = $form->id;
    //         $question_titles = DB::table('question_title')->where('form_id', $form_id)->get();

    //         foreach ($question_titles as $title) {
    //             $question_title_id = $title->id;
    //             $question_ones = DB::table('question_one')->where('question_title_id', $question_title_id)->get();
    //             $questions['Form Title'] = [];
    //             $questions['section'][$title->name] = [];



    //             foreach ($question_ones as $question_one) {
    //                 $question_one_id = $question_one->id;

    //                 $options_one = DB::table('options_one')->where('question_one_id', $question_one_id)->get();

    //                 $question_one->options = [];

    //                 foreach ($options_one as $option_one) {
    //                     $option_one_id = $option_one->id;

    //                     $question_two = DB::table('question_two')->where('options_one_id', $option_one_id)->get();

    //                     $option_one->question = [];

    //                     foreach ($question_two as $question_two) {
    //                         $question_two_id = $question_two->id;

    //                         $options_two = DB::table('options_two')->where('question_two_id', $question_two_id)->get();

    //                         $question_two->options = [];

    //                         foreach ($options_two as $option_two) {
    //                             $option_two_id = $option_two->id;

    //                             $question_threes = DB::table('question_three')->where('options_two_id', $option_two_id)->get();

    //                             $option_two->question = [];

    //                             foreach ($question_threes as $question_three) {
    //                                 $question_three_id = $question_three->id;

    //                                 $option_threes = DB::table('option_three')->where('question_three_id', $question_three_id)->get();

    //                                 $question_three->option = [];

    //                                 foreach ($option_threes as $option_three) {
    //                                     $option_three_id = $option_three->id;

    //                                     $question_fours = DB::table('question_four')->where('option_three_id', $option_three_id)->get();

    //                                     $option_three->question = $question_fours;
    //                                 }

    //                                 $question_three->option = $option_threes;
    //                             }

    //                             $option_two->question = $question_threes;
    //                         }

    //                         $question_two->options = $options_two;
    //                     }

    //                     $option_one->question = $question_two;
    //                 }

    //                 $question_one->options = $options_one;
    //                 $questions['section'][$title->name][] = $question_one;
    //                 $questions['Form Title'] = $form->name;

    //             }
    //         }
    //     }

    //     return $questions;



    // }

    public function survey_form1(Request $request)
    {
        $forms = DB::table('form')->get();
        $questions = [];
        foreach ($forms as $item) {
            $questions['form'] = $item->name;
            $item->form = $item;
            $question_title = DB::table('question_title')->where('form_id', $item->id)->get();
            foreach ($question_title as $section) {
                $questions_data = DB::table('questions')->where('section_id', $section->id)->get();
                $section->section = $section;
                    foreach ($questions_data as $ques) {
                        $options = DB::table('options')->where('question_id', $ques->id)
                            ->select('id as option_id', 'name', 'question_id')
                            ->get();
                        $ques->options = $options;

                    }
                    $questions['section'][$section->name] = [];
                    $questions['section'][$section->name] = $questions_data;
                    
                }
            }
        }

        public function survey_form(Request $request)
{
    
    $forms = DB::table('form')
    ->select('id','name')
    ->get();
    $result = [];
    foreach ($forms as $form) {
        $result[$form->name] = [
            'sections' => null
        ];

        $sections = DB::table('question_title')->where('form_id', $form->id)
        ->select('id','name','sub_heading','form_id')
        ->get();

        foreach ($sections as $section) {
            $result[$form->name]['sections'][$section->name] = [
                'section' => $section,
                'questions' => null
            ];

            $questions = DB::table('questions')->where('section_id', $section->id)
            ->select('id','name','option_id','placeholder','section_id','type','answer')
            ->get();
            
            foreach ($questions as $question) {
                
                $options = DB::table('options')->where('question_id', $question->id)
                ->select('id as option_id', 'name', 'question_id')
                ->get();

                if(count($options)<=0){
                    $options=null;
                }                    
                 
                $result[$form->name]['sections'][$section->name]['questions'][] = [
                    'question' => $question ,
                    'options' => $options 
                ];
            }
        }
    }

    return $result;
}

    }

    















