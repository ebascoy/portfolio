<?php

namespace App\Http\Controllers\Polls;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PollsController extends Controller
{
    public function index()
    {
        return view('polls.home');
    }
}
