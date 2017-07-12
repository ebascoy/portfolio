<?php

namespace App\Http\Controllers\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Polls;

class PollsController extends Controller
{
    public function index()
    {
        $polls = Polls::all();
        return view('polls.home', compact('polls'));
    }
    public function show($poll_id)
    {
        $poll = Polls::wherePoll_id($poll_id);
        return view('polls.vote', compact('poll'));
    }
    public function create()
    {
        return view('polls.create');
    }
    public function store()
    {

    }
}
