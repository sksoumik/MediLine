<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'MediLine') }}
            </a>
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/medicine">Explore</a></li>
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}" style = "background: transparent;
  border: 1px solid blue; margin-top: 10px ;padding: 4px; border-radius: 6px;">Login/Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            @if(\Auth::user()->adminFlag)
                            <li>
                                <a href="/Dashboard">Dashboard</a>
                            </li>

                            @endif
                            @if(auth()->guard('owner')->check())
                                    <li>
                                        <a href="/owner">Owner dashboard</a>
                                    </li>

                                @else
                                    <li >
                                        <a href="{{route('medicine.shoppingCart')}}">
                                            <i class="glyphicon glyphicon-shopping-cart">Your cart</i>
                                            <span class="badge">{{Session::has('cart') ?
                                            Session::get('cart')->totalQty : ''}}</span>
                                        </a>
                                    </li>

                                <li>
                                    <a  class="glyphicon glyphicon-user" href="/profile/{{\Auth::user()->id}}">profile</a>
                                </li>
                                @endif
                            <li>
                                <a class="glyphicon glyphicon-log-out" href="{{ route('logout') }}"
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
        </div>
    </div>
</nav>
