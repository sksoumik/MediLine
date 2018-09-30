<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>MediLine</title>
</head>
<body>
  <!--NAVBAR-->

  <nav class="navbar navbar-toggleable fixed-top">
   <div class="container">
     <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarCollapse">
       <span class="navbar-toggler-icon"></span>
     </button>
     <a href="/" class="navbar-brand"><i class="fa fa-circle fa-lg"></i>MediLine</a>
     <div class="collapse navbar-collapse" id="navbarCollapse">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item">
           <a class="nav-link" href="/">Home</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="/medicine">Explore</a>
         </li>
           @if(auth()->guard('owner')->check())
              <li class="nav-item">
                <a class="nav-link" href="/owner">Your dashboard</a>
               </li>
               @endif
          @guest
               @if(!auth()->guard('owner')->check())
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ml-3" href="/login">Login/Sign up</a>
                   </li>
               @endif
                @else
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle"data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            @if(\Auth::user()->adminFlag)
                            <li>
                                <a href="/Dashboard">Dashboard</a>
                            </li>
                            @endif
                                <li >
                                    <a href="/profile/{{\Auth::user()->id}}">profile</a>
                                </li>
                                <li >
                                    <a href="{{route('medicine.shoppingCart')}}">
                                        <i class="fa fa-shopping-cart">Your cart</i>
                                        <span class="badge">{{Session::has('cart') ?
                                            Session::get('cart')->totalQty : ''}}</span>
                                    </a>
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
     </div>
   </div>
</nav>

<!--Header section-->
<header id="home-section">
  <div class="home-inner">
    <div class="container">
      <div class="row justify-content-center">
          <h2 class="display-4 text-white">Order medicines online</h2>
      </div>
      <div class="row justify-content-center">
        <p class="lead text-white d-block">Get every medicine. On time. Everytime.</p>
      </div>
    </div>
  </div>
</header>


<!--CARD section-->


  <section id="home-card" style="margin-top: -125px;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="card"  style="width:33rem">
          <div class="row p-3">
            <div class="col-md-8 pt-3">
              <p class="lead">In need of medicine urgently? We are here for you. Get your desired med in your doorstep 24x7</p>
            </div>
            <div class="col-md-3 offset-1">
              <img src="{{ asset('images/card.svg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<section id="home-med-section">
  <div class="container">
        <div class="row justify-content-end">
          <div class="col-md-5 offset-1">
            <h2>Get every medicine</h2>
            <p class="text-justify">When you purchase medicines on MediLine, you can be assured that you will get the medicines you order. Practo has the widest range of medicines online, sourced from our trusted network of pharmacies and medical stores.</p>
            <a href="/medicine" class="btn btn-outline-primary">Order now</a>
          </div>
          <div class="col-md-5 offset-1">
            <img src="{{ asset('images/med.svg') }}" alt="">
         </div>
        </div>
    </div>
</section>

<!--get med everyday-->>

<section id="explore-section" class="bg-faded text-muted py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-5 offset-1">
           <img src="images/calendar.svg" style="margin-top:-50px"alt="">
        </div>
        <div class="col-md-5 offset-1">
        <h2>Get medicine everytime</h2>
        <p class="lead">
          Unlike a regular medical store, MediLine is powered by intelligent systems that remembers all the medicines you ordered online and makes sure they're always available whenever you need them. So, you'll always find your medicines on MediLine online pharmacy, anywhere in Bangladesh*.
        </p>
        @if(Auth::guest())
        <a href="/register" class="btn btn-outline-success">Sign Up Now!!</a>
        @endif
        </div>
      </div>
    </div>
  </section>


<!--about us-->
<section id="about-us">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h2>Who are we?</h2>
        <p class="lead">We the dubmest students of NSU :3. And CSE-327 is
        ruining my entire semester -_- single handedly</p>
      </div>
      <div class="col-md-4">
        <img src="images/home.jpg" alt="" class="img-fluid mb-3 rounded-circle">
      </div>
    </div>
  </div>
</section>


<!--android-->
<section id="android-section" class="bg-faded">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <img src="images/pixel2.png" alt="" class="img-fluid mb-3 rounded-circle">
      </div>
      <div class="col-md-6 offset-2">
        <h2>Android App coming soon</h2>
      </div>
    </div>
  </div>
</section>

<footer id="main-footer">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <div class="py-4">
            <h3 class= "display-4"> <i class="fa fa-circle fa-lg"></i>MediLine</h3>
            
            <p>Copyright &copy; 2017</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col text-center">
            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#contactModal">Contact Us</button>
          </div>
        </div>
      </div>
    </div>
  </footer>

        <!--Script tags-->
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<!--CDN js-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>
