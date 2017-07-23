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
        $index_polls = $this->getIndexPolls();
        $polls = $index_polls['polls'];
        $title = $index_polls['title'];

        return view('polls.home', compact('polls', 'title'));
    }

    public function show($poll_id)
    {
        $poll = Poll::find($poll_id);
        $choices = Choice::where('poll_id', '=', $poll_id)->get();
        $chart_data = DB::table('votes')
            ->join('choices', 'choices.id', '=', 'votes.choice_id')
            ->select('choices.name', DB::raw('count(*) as total'))
            ->where('votes.poll_id', '=', $poll_id)
            ->groupBy('choices.name')
            ->get();
        return view('polls.vote', compact('poll', 'choices', 'chart_data'));
    }

    public function create()
    {
        if (! Auth::check()) {
            $polls = Poll::all();
            $title = 'Polls Home';
            session()->flash('status', 'You must sign in to view that page.');
            return view('polls.home', compact('polls', 'title'));
        }
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

    protected function getIndexPolls() {
        // Two pages, home and my-polls use this function
        // If user is authenticated and going to my-polls,
        // get user's polls and set title to My Polls
        if (Auth::user() && request()->path() == 'polls/my-polls') {
            $polls = Poll::where('user_id', '=', Auth::user()->id)->get();
            $title = 'My Polls';
        } else {
            // If the user got here, he's either not authenticated
            // or is going to Home (or both). Either way, they're going
            // to be redirected to the Home view which lists all polls,
            // so get all the polls and set the title to Home
            $polls = Poll::all();
            $title = 'Polls Home';
            // If the user was trying to get to my-polls and got to this
            // point, then the user is not authenticated, in which case
            // we send the user to Home with an error message.
            if (request()->path() == 'polls/my-polls') {
                session()->flash('status', 'You must sign in to view that page.');
            }
        }

        return [
            'polls' => $polls,
            'title' => $title
        ];
    }
}