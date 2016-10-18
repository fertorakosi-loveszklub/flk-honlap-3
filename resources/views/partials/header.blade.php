<header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="top-bar">&nbsp;</div>
            </div>
        </div>
        
        <div class="row" id="title-row">
            <div class="hidden-xs col-sm-5" id="logo-container">
                <a href="/" target="_blank">
                    <img id="logo" src="/img/logo.png" alt="Fertőrákosi Lövészklub">
                </a>
            </div>

            <div class="col-xs-12 col-sm-7" id="title-container">
                <h1>
                    <span class="row-1">Fertőrákosi</span>
                    <span class="row-2">Lövészklub</span>
                </h1>
            </div>

            <div id="user-box">
                @if (!Auth::check())
                    <a href="/facebook/login" class="btn btn-basic">
                        <i class="visible-xs fa fa-fw fa-sign-in"></i>
                        <i class="hidden-xs fa fa-fw fa-facebook"></i>
                        <span class="hidden-xs">Bejelentkezés</span>

                        <span id="hover-indicator" class="hidden-xs">
                            <i class="fa fa-sign-in fa-fw"></i>
                        </span>
                    </a>
                @else
                    <div class="user-menu">
                        <span>Szia, {{ Auth::user()->name }}!</span>
                        @if (Auth::user()->isAdmin())
                            <a href="/admin" class="btn btn-basic">
                                <i class="fa fa-fw fa-cog"></i> Admin
                            </a>
                        @endif
                        <a href="/auth/logout" class="btn btn-basic">
                            <i class="fa fa-fw fa-sign-out"></i> Kilépés
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <button id="main-menu-toggle" class="visible-xs btn btn-basic">
            <i id="toggle--open" class="fa fa-fw fa-bars"></i>
            <i id="toggle--close" class="fa fa-fw fa-times"></i>
        </button>
        <div class="row" id="main-menu-row">
            <div class="col-xs-12">
                <nav>
                    <ul>
                        <li><a href="/">Főoldal</a></li>
                        <li><a href="/info">Rólunk</a></li>
                        <li><a href="/hirek">Hírek</a></li>
                        <li><a href="/kepek">Galéria</a></li>
                        <li><a href="/dokumentumok">Dokumentumok</a></li>
                        <li><a href="/kapcsolat">Kapcsolat</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
