<?php

namespace App\Http\Controllers\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Choice;
use App\Http\Requests\CreatePollForm;

class PollsController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return view('polls.home', compact('polls'));
    }

    public function show($poll_id)
    {
        $poll = Poll::find($poll_id);
        return view('polls.vote', compact('poll'));
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
        $poll->user_id = 1;
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