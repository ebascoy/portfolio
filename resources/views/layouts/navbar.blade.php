<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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
                <li><a href="/api/docs">API Docs</a></li>
                @if (Auth::guest())
                    <li>
                        <div>
                            <a href="{{ url('/auth/twitter') }}?last-url={!! htmlentities(request()->path()) !!}"
                               class="btn btn-raised">
                                <img src="/images/sign-in-with-twitter-link.png" alt="Sign in with Twitter">
                            </a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="{{ url('/auth/facebook') }}?last-url={!! htmlentities(request()->path()) !!}"
                               class="btn" style="padding: 0;">
                                <img src="/images/sign-in-with-facebook.png"
                                     height="36px" width="222px"
                                     alt="Sign in with Facebook">
                            </a>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="twitter-avatar-div">
                            <img src="{{ Auth::user()->avatar }}" height="40" width="40" class="img-circle">
                        </div>
                    </li>
                    <li><a href="/logout"
                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">Polls
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/polls/home">Home</a></li>
                        @if (Auth::check())
                            <li><a href="/polls/my-polls">My Polls</a></li>
                            <li><a href="/polls/create">New Poll</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>