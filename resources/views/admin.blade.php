<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FLK Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/ui/trumbowyg.min.css" />
</head>
<body>

<div class="hidden">
    @include('partials.trumbo-svg')
</div>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin">
                FLK
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">
                        <img src="//graph.facebook.com/{{ Auth::user()->facebook_user_id }}/picture?height=18" alt="profilkép">
                        {{ Auth::user()->name }}
                    </a>
                </li>
                <li><a href="/">Vissza az oldalra </a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
                <div class="alert alert-{{ session('status')['type'] }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status')['message'] }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Menü
                </div>

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/admin/news">Hírek</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/galleries">Galériák</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/documents">Dokumentumok</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/pages">Tartalmak</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-lg-10">
            @yield('content')
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/trumbowyg.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.3.0/langs/hu.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
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
