@extends('layouts.master')
@section('title', 'Polls Home')

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    {{ $poll->name }}
                </h1>
                <h3 class="text-center margin-top-100 editContent">
                    Vote on this poll!
                    </a>
                </h3>
            </div>
        </div>
    </div>
@endsection