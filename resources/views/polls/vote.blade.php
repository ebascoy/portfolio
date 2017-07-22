@extends('layouts.master')
@section('title', 'View Poll')

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
                            <div class="col-md-4">
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
                                @if(auth::check())
                                    <div class="form-group col-md-10">
                                    <label for="new-choice"
                                           class="control-label dark-text">... or enter a new choice</label>
                                    <input type="text" class="form-control" id="new-choice"
                                           name="new-choice" value="{!! old('new-choice') !!}">
                                    </div>
                                @endif
                            </div>
                            <canvas class="col-md-offset-4"
                                    id="poll-result-chart"
                                    width="400px"
                                    height="400px">
                            </canvas>
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
@section('other_scripts')
    @if($chart_data)
        <script>
            let chartLabels = [];
            let chartValues = [];
            let backgroundColors = [];

            let randomColorGenerator = function () {
                return '#' + (Math.random().toString(16) + '0000000').slice(2, 8);
            };
            @foreach ($chart_data as $data)
                chartLabels.push("{{ $data->name }}");
                chartValues.push({{ $data->total }});
                backgroundColors.push(randomColorGenerator());
            @endforeach

            var chartData = {
                    datasets: [{
                        data: chartValues,
                        backgroundColor: backgroundColors
                    }],
                    labels: chartLabels
                };
        </script>
    @endif
    <script src="{!! asset('js/poll-result-chart.js') !!}"></script>
@endsection