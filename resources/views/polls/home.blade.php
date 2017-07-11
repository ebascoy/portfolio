@extends('layouts.master')
@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    Polls by Bascoy
                </h1>
                <h3 class="text-center margin-top-100 editContent">
                    Select a poll to see the results and vote, or <a href="/polls/create">
                        make a new poll!
                    </a>
                </h3>
                @foreach ($polls as $poll)
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            <a href="/polls/show/{{ $poll->poll_id }}">
                                {{ $poll->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection