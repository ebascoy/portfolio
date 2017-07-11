@extends('layouts.master')
@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    API Docs
                </h1>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <a href="#">Request Header Parser</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <a href="#">Short URL Creator</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <a href="#">Google Image Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection