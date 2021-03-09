<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="TemplateMo">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Bootstrap core CSS -->
<link href="\css\front-css\bootstrap.min.css" rel="stylesheet">
<script>
     window.Laravel = 
     <?php
      if(Auth::check()){ 
          echo json_encode(['api_token' => (Auth::user()->api_token),'user' => Auth::user()]); 
      }else{
        echo json_encode(['api_token' =>'null','user' => 'null']); 
      }
      ?>
  
</script>
 

    
<!-- Additional CSS Files 
<link rel="stylesheet" href="\Performance\public\css\front-css\fontawesome.css"> -->
<link rel="stylesheet" href="\css\front-css\templatemo-stand-blog.css">
<link rel="stylesheet" href="\css\front-css\owl.css">
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
</head>
  
  <body>
  <div id="app">  
  

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}"><h2>Perfomance<em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{route('about-us')}}">About Us</a>
              </li>

              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      Categories<span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                       <dropdown></dropdown>
                  </div>
                </li>
             
             
              <li class="nav-item">
                <a class="nav-link" href="{{route('contact-us')}}">Contact Us</a>
              </li>
               
              <!-- Authentication Links -->
               @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                @endguest
              </ul>
           
          </div>
        </div>
      </nav>
    </header>
  
    @yield('content')
 
  <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="/Performance/public/">Home</a></li>
              <li><a href="/Performance/public/about-us">About-us</a></li>
              <li><a href="/Performance/public/contact-us">Contact-us</a></li>
            
            </ul>
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>Copyright 2020 YourWebDev.
                    
                 | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">Your WebDev</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
     
   <!-- <script src="\Performance\public\js\front-js\jquery.min.js"></script> -->
    <script src="\js\front-js\bootstrap.bundle.min.js"></script>  

    <!-- Additional Scripts -->
    <script src="\js\front-js\custom.js"></script>
    <script src="\js\front-js\owl.js"></script>
    <script src="\js\front-js\slick.js"></script>
    <script src="\js\front-js\isotope.js"></script>
    <script src="\js\front-js\accordions.js"></script> 

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      } 
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
  </body>
</html>    