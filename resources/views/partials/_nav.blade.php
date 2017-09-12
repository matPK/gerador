<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}">SIGM</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @guest
                
                @else
                    <li><a href="{{route('overview')}}">Overview</a></li>
                    @if(Auth::user()->hasRole('superadministrator|administrator'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">General</li>
                                <li><a href="{{route('users.index')}}">Users</a></li>
                                <li><a href="{{route('groups.index')}}">Groups</a></li>
                                
                                @if(Auth::user()->hasRole('superadministrator'))
                                    <li><a href="{{route('clients.index')}}">Clients</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Roles & Permissions</li>
                                    <li><a href="{{route('roles.index')}}">Roles</a></li>
                                    <li><a href="{{route('permissions.index')}}">Permissions</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endguest
              </ul>
            <ul class="nav navbar-nav navbar-right">
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <!--<li><a href="{{ route('register') }}">Register</a></li>-->
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>