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