<?php

namespace App\Http\Controllers\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vote;
use App\Choice;
use Auth;

class VotesController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $rules = [
                'choice' => 'required_without_all:new-choice',
                'new-choice' => 'required_without_all:choice'
            ];
        } else {
            $rules = ['choice' => 'required'];
        }
        $this->validate($request, $rules);
        if ($new_choice = $request->get('new-choice')) {
            $choiceModel = new Choice;
            $choiceModel->name = $new_choice;
            $choiceModel->poll_id = $request->get('poll_id');
            $choiceModel->saveOrFail();
            $choice_id = $choiceModel->id;
        } else {
            $choice_id = $request->get('choice');
        }
        $vote = new Vote;
        $vote->poll_id = $request->get('poll_id');
        $vote->choice_id = $choice_id;
        $vote->saveOrFail();
        $request->session()->flash('status', 'Your vote was saved.');
        $request->session()->flash('data', $vote->choice_id);
        return redirect("polls/show/$vote->poll_id");
    }
}
