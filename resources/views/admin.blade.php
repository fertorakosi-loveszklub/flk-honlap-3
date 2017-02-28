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
                <a href="#name-modal" class="modal-trigger"><span class="white-text name">{{ Auth::user()->name }}</span></a>
            </div>
        </li>
        <li @if (session('admin_module') == 'news')class="active"@endif><a href="/admin/news">Hírek</a></li>
        <li @if (session('admin_module') == 'gallery')class="active"@endif><a href="/admin/galleries">Galéria</a></li>
        <li @if (session('admin_module') == 'documents')class="active"@endif><a href="/admin/documents">Dokumentumok</a></li>
        <li @if (session('admin_module') == 'pages')class="active"@endif><a href="/admin/pages">Tartalmak</a></li>
        <li @if (session('admin_module') == 'member')class="active"@endif><a href="/admin/members">Tagok</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse top-nav full hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</header>

<main>
    <div class="container">
        @if (session('status'))
            <div class="alert alert-{{ session('status')['type'] }}">
                {{ session('status')['message'] }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

<div id="name-modal" class="modal" style="max-width: 450px;">
    <form action="/admin/name" method="POST">
        {{ csrf_field() }}
        <div class="modal-content">
            <h4>Név megváltoztatása</h4>
            <div class="input-field">
                <label for="custom_name">Neved</label>
                <input type="text" id="custom_name" name="custom_name"
                    value="{{ auth()->user()->name }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn blue modal-action waves-effect waves-green">
                Mentés
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/trumbowyg.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/langs/hu.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.modal-trigger').leanModal();
        $(".button-collapse").sideNav();

        $('.trumbowyg').trumbowyg({
            lang: 'hu',
        });

        $(".red").click(function (e) {
            if (! confirm('Biztos vagy benne?')) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
</body>
</html>
