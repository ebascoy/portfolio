@extends('layouts.master')

@section('title', 'View Poll')

@section('meta-tags')
    <meta property="og:url" content="{!! request()->url() !!}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{!! $poll->name !!}" />
    <meta property="og:description" content="Vote Now!" />
    <meta property="og:image" content="{!! request()->getBaseUrl() !!}/images/sign-in-with-twitter-link.png" />
@endsection

@section('content')
    <div class="container">
        <div class="row banner">
            <div class="col-md-12">
                <h1 class="text-center margin-top-100 editContent">
                    {{ $poll->name }}
                </h1>
                <div class="container" id="social-buttons">
                    <a class="twitter-share-button"
                       href="https://twitter.com/share"
                        data-text="{{ $poll->name }} Vote now!"
                        data-url="{!! request()->url() !!}"
                       data-size="large">
                        Tweet</a>
                    <div class="fb-share-button"
                         data-href="{!! request()->url() !!}"
                         data-layout="button"
                         data-size="large"
                         data-mobile-iframe="true"
                         style="vertical-align:top;">
                        <a class="fb-xfbml-parse-ignore"
                           target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?
                           u=http%3A%2F%2Flocal.elybascoy.com%3A8000%2Fpolls%2Fshow%2F1&amp;
                           src=sdkpreparse">Share</a>
                    </div>
                </div>
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="well">
                    <form class="form-horizontal col-md-6" method="post" id="vote-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                        <fieldset>
                            <div class="form-group">
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
                            </div>
                            @if(auth::check())
                                <div class="form-group col-md-10">
                                    <label for="new-choice"
                                           class="control-label dark-text">... or enter a new choice</label>
                                    <input type="text" class="form-control" id="new-choice"
                                           name="new-choice"
                                           @if (old('new-choice'))
                                               value="{!! old('new-choice') !!}"
                                           @endif
                                    >
                                </div>
                            @endif
                            {{--<div class="form-group">--}}
                                <div class="col-lg-10">
                                    <button class="btn btn-raised btn-default">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-raised btn-primary">
                                        Submit
                                    </button>
                                </div>
                            {{--</div>--}}
                        </fieldset>
                    </form>
                    <canvas class="col-md-offset-6"
                            id="poll-result-chart">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('other_scripts')
    @if($chart_data)
        <script>
            let form_height = $('#vote-form').height();
            let available_canvas_width = $('.well').width() / 2;
            let poll_result_chart = $('#poll-result-chart');
            poll_result_chart.height(form_height);
            if (form_height > available_canvas_width) {
                poll_result_chart.width(available_canvas_width);
            } else {
                poll_result_chart.width(form_height);
            }
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