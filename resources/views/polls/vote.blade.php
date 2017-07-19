@extends('layouts.master')
@section('title', 'Polls Home')

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    {{ $poll->name }}
                </h1>
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
                    <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                    <fieldset>
                        <div class="well">
                            @foreach ($choices as $choice)
                                <div class="radio">
                                    <label class="dark-text">
                                        <input type="radio"
                                               name="choice"
                                               value="{{ $choice->id }}"
                                                @if (old('choice') && old('choice') == $choice->id ||
                                                    session('data') && session('data') == $choice->id)
                                                    checked=""
                                                @endif
                                                > {{ $choice->name }}
                                    </label>
                                </div>
                            @endforeach
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
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection