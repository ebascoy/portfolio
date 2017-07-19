@extends('layouts.master')
@section('title', 'Create New Poll')

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    Polls by Bascoy
                </h1>
                <h2 class="text-center">
                    Create A New Poll
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <fieldset>
                        <div class="well">
                            <div class="form-group">
                                <label for="name" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="name" placeholder="Poll Name"
                                           name="name" value="{!! old('name') !!}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button type="button"
                                        id="choice-button"
                                        class="btn btn-raised btn-default">
                                    Add Choice
                                </button>
                            </div>
                        </div>
                        <div class="well" id="choices-form-group" style="display:none"></div>
                        <div class="form-group">
                            <div class="col-lg-10">
                                <button class="btn btn-raised btn-default">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-raised btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('other_scripts')
    @if (old('choices'))
        <script>
            var choices = [];
            @foreach (old('choices') as $choice)
                choices.push("{{ $choice }}");
            @endforeach
        </script>
    @endif
    <script src="{!! asset('js/polls.js') !!}"></script>
@endsection