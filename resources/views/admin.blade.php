<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FLK Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/ui/trumbowyg.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css" />
</head>
<body id="admin">

<div style="display: none">
    @include('partials.trumbo-svg')
</div>

<header>
    <nav class="top-nav">
        <div class="container">
            <div class="nav-wrapper"><a class="page-title">{{ $title or "Hírek" }}</a></div>
        </div>
    </nav>

    <ul id="nav-mobile" class="side-nav fixed">
        <li>
            <div class="userView">
                <img src="//i.imgur.com/R3bj5JE.jpg" class="background" alt="">
                <a href="#!user"><img class="circle" src="//graph.facebook.com/{{ Auth::user()->facebook_user_id }}/picture?height=65" /></a>
                <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
            </div>
        </li>
        <li><a href="/admin/news">Hírek</a></li>
        <li><a href="/admin/galleries">Galéria</a></li>
        <li><a href="/admin/documents">Dokumentumok</a></li>
        <li><a href="/admin/pages">Tartalmak</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</header>

@if (session('status'))
    <div class="alert alert-{{ session('status')['type'] }}">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('status')['message'] }}
    </div>
@endif

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/trumbowyg.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/langs/hu.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".button-collapse").sideNav();

        $('.trumbowyg').trumbowyg({
            lang: 'hu',
        });

        $(".btn-danger").click(function (e) {
            if (! confirm('Biztos vagy benne?')) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
</body>
</html>
