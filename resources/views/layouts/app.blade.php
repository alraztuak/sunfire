<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
   
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <link rel="stylesheet" href="{{ asset('css/mvpready-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mvpready-flat.css') }}">

    @stack('headerscripts')
</head>

<body>
<div id="wrapper">
        <header class="navbar navbar-inverse navbar-expand-md " role="banner">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }} |
                        </a>

                        <div class="navbar-collapse" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            @auth
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                    <ul class="navbar-nav  mr-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Data Center
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">

                                                <div class="dropdown-submenu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                    <a class="dropdown-item" href="{{ route('aturanxsim.index') }}"><i class="fas fa-md fa-book"></i> Peraturan Pajak</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:12px">
                                                        <a href="{{ route('aturantopikxsim.index') }}" class="dropdown-item">
                                                                <i class="fas fa-md fa-pen"></i>&nbsp;&nbsp;Add Topik
                                                        </a>
                                                        <a href="{{ route('aturanjenisxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-alt"></i>&nbsp;&nbsp;Add Jenis
                                                        </a>
                                                        <a href="{{ route('aturaninfoxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-fancy"></i>&nbsp;&nbsp;Add Info Status
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="dropdown-submenu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                    <a class="dropdown-item" href="{{ route('putusanxsim.index') }}"><i class="fas fa-md fa-book"></i> Putusan Pajak</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:12px">
                                                        <a href="{{ route('putusancatxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-alt"></i>&nbsp;&nbsp;Add Jenis
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="dropdown-submenu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                    <a class="dropdown-item" href="{{ route('treatyxsim.index') }}"><i class="fas fa-md fa-atlas"></i> Tax Treaty</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:12px">
                                                        <a href="{{ route('treatyinfoxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-fancy"></i>&nbsp;&nbsp;Add Info Negara
                                                        </a>
                                                        <a href="{{ route('treatyjenisxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-alt"></i>&nbsp;&nbsp;Add Jenis
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="dropdown-submenu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                    <a class="dropdown-item" href="{{ route('kppxsim.index') }}"><i class="fas fa-md fa-journal-whills"></i> Daftar KPP</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:12px">
                                                        <a href="{{ route('kppjenisxsim.index') }}" class="dropdown-item">
                                                            <i class="fas fa-md fa-pen-alt"></i>&nbsp;&nbsp;Add Jenis
                                                        </a>
                                                    </div>
                                                </div>

                                            <hr />
                                                 <a class="dropdown-item" href="{{ route('kursmkxsim.index') }}"><i class="fas fa-md fa-coins"></i> Kurs MK</a>
                                                 <a class="dropdown-item" href="{{ route('kursbixsim.index') }}"><i class="fas fa-md fa-money-bill-wave"></i> Kurs BI</a>
                                                 <a class="dropdown-item" href="{{ route('kurskodexsim.index') }}"><i class="fas fa-md fa-dollar-sign"></i> Kurs Kode</a>
                                                  
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Content Center
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                <div class="dropdown-submenu" aria-labelledby="navbarDropdownMenuLink" style="font-size:13px">
                                                    <a class="dropdown-item" href="{{ route('contentxsim.index') }}"><i class="fas fa-md fa-edit"></i> Content Editor</a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="font-size:12px">
                                                        <a class="dropdown-item" href="{{ route('contentcatxsim.index') }}"><i class="fas fa-md fa-clone"></i> Content Categories</a>
                                                    </div>
                                                </div>
                                            <hr />
                                                <a class="dropdown-item" href="{{ route('highlightxsim.index') }}"><i class="fas fa-md fa-highlighter"></i> Highlights</a>
                                                <a class="dropdown-item" href="{{ route('trendingxsim.index') }}"><i class="fas fa-md fa-bookmark"></i> Trending</a>
                                                <a class="dropdown-item" href="{{ route('tagxsim.index') }}"><i class="fas fa-md fa-tags"></i> Tag Manager</a>
                                            </div>
                                        </li>
                                    </ul>
                            @endauth
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-key"></i> {{ __('Login') }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        
                                            <a href="#" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fas fa-user"></i>  {{ Auth::user()->name }},
                                            </a> 

                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }} <i class="fas fa-door-open"></i> 
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        
                                    </li>
                                @endguest
                            </ul>
                        </div>
        </header>
        <div class="wrapper">

            <div class="content" style="margin-top:20px">
                <div class="container">
                    <div class="row">
                    @if(session()->has('success'))
                        <div class="col-md-12 alert alert-success text-center">
                         <h5>{{ session()->get('success') }}</h5>
                        </div>
                    @endif

                    @if(session()->has('warning'))
                        <div class="col-md-12 alert alert-warning text-center">
                         <h5>{{ session()->get('warning') }}</h5>
                        </div>
                    @endif
                    
                        <div class="col-md-12 ">
                            @yield('content')
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- /#wrapper -->

</div> <!-- /#wrapper -->
<footer class="footer">
  <div class="container">
    <p class="pull-left">Copyright &copy; 2019. SUNFIRE</p>
  </div>
</footer>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script language="JavaScript" type="text/javascript"src="{{ asset('js/mvpready-core.js') }}"></script>  
        <script language="JavaScript" type="text/javascript"src="{{ asset('js/mvpready-admin.js') }}"></script>  
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        @stack('footerscripts')
</body>
</html>
