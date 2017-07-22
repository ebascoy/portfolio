<?php

namespace App\Http\Controllers\Polls;

use App\Choice;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePollForm;
use App\Poll;
use Auth;
use Illuminate\Support\Facades\DB;

class PollsController extends Controller
{
    public function index()
    {
        if (request()->path() == 'polls/home') {
            $polls = Poll::all();
            $title = 'Polls Home';
        } else {
            $polls = Poll::where('user_id', '=', Auth::user()->id)->get();
            $title = 'My Polls';
        }
        return view('polls.home', compact('polls', 'title'));
    }

    public function show($poll_id)
    {
        $poll = Poll::find($poll_id);
        $choices = Choice::where('poll_id', '=', $poll_id)->get();
        $chart_data = DB::table('votes')
            ->join('choices', 'choices.id', '=', 'votes.choice_id')
            ->select('choices.name', DB::raw('count(*) as total'))
            ->groupBy('choices.name')
            ->get();
        return view('polls.vote', compact('poll', 'choices', 'chart_data'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(CreatePollForm $request)
    {
        $poll = new Poll;
        $poll->name = ($request->get('name'));
        // user_id is a placeholder during dev until I implement user
        $poll->user_id = Auth::user()->id;
        $poll->saveOrFail();
        $poll_id = $poll->id;
        $choices = $request->get('choices');
        foreach ($choices as $choice) {
            $choiceModel = new Choice;
            $choiceModel->name = $choice;
            $choiceModel->poll_id = $poll->id;
            $choiceModel->saveOrFail();
        }

        return redirect("polls/show/$poll_id");
    }
}