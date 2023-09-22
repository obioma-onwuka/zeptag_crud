<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title') | Contact manager, Todo manager and Notes</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
        <!-- Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        

        @vite(['resources/css/ui/css/bootstrap.min.css'])
        @vite(['resources/css/ui/css/custom.css'])
        @vite(['resources/css/ui/css/jasny-bootstrap.min.css'])


    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="/">            
                    <strong>Contact</strong> App
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <!-- /.navbar-header -->
                <div class="collapse navbar-collapse" id="navbar-toggler">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Companies</a>
                        </li>
                        <li class="nav-item active">
                            <a href="{{route('contacts.index')}}" class="nav-link">Contacts</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mr-2">
                            <a href="#" class="btn btn-outline-secondary">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-primary">
                                Register
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                John Doe
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="profile.html">
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{$slot}}


        @vite(['resources/js/ui/js/bootstrap.min.js'])
        @vite(['resources/js/ui/js/jasny-bootstrap.min.js'])
        @vite(['resources/js/ui/js/jquery.min.js'])
        @vite(['resources/js/ui/js/popper.min.js'])

    </body>
</html>