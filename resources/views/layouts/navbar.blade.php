<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Ely Bascoy</a>
        </div>

        <!-- navbar right -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/api/docs">API Docs</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">Polls
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        {{--@if (Auth::check())--}}
                            {{--@role('manager')--}}
                                {{--<li><a href="/admin">Admin</a></li>--}}
                            {{--@endrole--}}
                            {{--<li><a href="/users/logout">Logout</a></li>--}}
                        {{--@else--}}
                            <li><a href="/polls/home">Home</a></li>
                            <li><a href="/polls/login">Login</a></li>
                            <li><a href="/polls/my-polls">My Polls</a></li>
                            <li><a href="/polls/new">New Poll</a></li>
                            <li><a href="/polls/logout">Logout</a></li>
                        {{--@endif--}}
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>