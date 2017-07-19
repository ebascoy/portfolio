<?php

namespace App\Http\Controllers\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vote;

class VotesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [ 'choice' => 'required' ]);
        $vote = new Vote;
        $vote->poll_id = $request->get('poll_id');
        $vote->choice_id = $request->get('choice');
        $vote->saveOrFail();
        $request->session()->flash('status', 'Your vote was saved.');
        $request->session()->flash('data', $vote->choice_id);
        return redirect("polls/show/$vote->poll_id");
    }
}
