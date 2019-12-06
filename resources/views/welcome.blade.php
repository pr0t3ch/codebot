<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <link rel="stylesheet" href="{{mix('/css/app.css')}}" />

</head>

<body class="blue-grey lighten-5">

    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="assets/img/leaf_background.jpg">
                </div>
                <a><img class="circle" src="https://secure.gravatar.com/avatar/3fca4c87d0ca7200272c7c97d0f69d75" alt=""></a>
                <a><span class="white-text name">Daniel Dauber</span></a>
                <a href="https://github.com/danieldauber/"><span class="white-text email">@danieldauber</span></a>
            </div>
        </li>
    </ul>
    
    <nav id="main-nav">
        <div class="nav-wrapper container-fluid grey darken-4">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo"><i class="material-icons">chat</i>ChatBot</a>
                
                    <ul class="right hide-on-med-and-down">
                        <li data-target="slide-out" class="sidenav-trigger">
                            <i class="material-icons">menu</i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div id="app"></div>
    
    <script src="{{mix('/js/app.js')}}"></script>
    <script src="{{mix('/js/jquery-3.4.1.js')}}"></script>
    <script src="{{mix('/js/materialize.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
</body>

</html>