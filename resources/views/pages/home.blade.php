@extends('app')

@section('slider')
    <section id="slider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/img/jazmin.jpg" alt="Légfegyveres lövészet">
                <div class="carousel-caption">
                    <h2>Sportlövészet <br>
                        Kicsiknek és nagyoknak
                    </h2>
                </div>
            </div>
            {{--<div class="item">--}}
                {{--<img src="/img/gun-2.jpg" alt="Sportlövészet">--}}
                {{--<div class="carousel-caption">--}}
                    {{--<h2>Sportlövészet</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="item">--}}
                {{--<img src="/img/gun-3.jpg" alt="Íjászat">--}}
                {{--<div class="carousel-caption">--}}
                    {{--<h2>Íjászat</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </section>

    <div id="cta-container">
        <button id="contact-cta" class="btn" data-toggle="modal" data-target="#contact-modal">
            <i class="fa fa-fw fa-envelope-o"></i> Érdeklődöm
        </button>
    </div>
@endsection

@section('content')
    <div class="container" id="home">
        <div class="row" id="home--support">
            <div class="col-xs-12 text-center">
                <h2>Támogass minket!</h2>

                <p class="large">
                    Ajánld fel adód 1%-át klubunk részére!
                    <br>
                    Adószámunk: <strong>19105598-1-08</strong>
                </p>

                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">Próbáld ki magad!</h2>
            </div>
        </div>

        <div class="row text-center" id="home--services">
            <div class="col-xs-12 col-sm-4">
                <img src="/img/airgun_small_c.jpg" alt="Légfegyveres lövészet">
                <h3>Légfegyveres lövészet</h3>
                <p>Lövészet légfegyverekkel 10m-es távon <br> Légpuska, légpisztoly</p>
            </div>

            <div class="col-xs-12 col-sm-4">
                <img src="/img/gun_small.jpg" alt="Sportlövészet">
                <h3>Sportlövészet</h3>
                <p>Sportlövészet kis- és nagykaliberű fegyverekkel <br> Sportpisztoly 25m-es távon, sportpuska 50m-en</p>
            </div>

            <div class="col-xs-12 col-sm-4">
                <img src="/img/archery_small.jpg" alt="Tradícionális íjászat">
                <h3>Tradícionális íjászat</h3>
                <p>Hagyományőrző íjászat <br> Kicsiknek és nagyoknak egyaránt</p>
            </div>
        </div>


        <hr>

        <div id="edzes-info" class="text-center">
            <h4>Edzések minden szombaton!</h4>
        </div>

        <hr>

        @if (! $news->isEmpty())
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-center">Híreink</h2>
                </div>
            </div>

            <div class="row">
                @foreach($news as $article)
                    <article class="col-xs-12 col-sm-4">
                        <a href="/hirek/{{ $article->slug }}"><h1>{{ $article->title }}</h1></a>
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                            {{ $article->publication->format('Y. F j.') }}
                        </time>

                        <p class="intro">
                            {{ str_limit($article->lead, 250) }}
                            <br>
                            <a href="/hirek/{{ $article->slug }}">Tovább &raquo;</a>
                        </p>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endsection

@section('scripts')
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="#contact-cta">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Küldj üzenetet!</h4>
                </div>
                <div class="modal-body">
                    @include('contact-form')
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#contact-form").submit(function (e) {
                var $self = $(this);
                e.preventDefault();

                if ($("#contact-email").val() == '') {
                    $("#contact-email").focus();
                    return false;
                }

                if ($("#contact-message").val() == '') {
                    $("#contact-message").focus();
                    return false;
                }

                $("#contact-form button")
                    .prop('disabled', true)
                    .html('<i class="fa fa-fw fa-circle-o-notch fa-spin"></i>');

                $.post($self.attr('action'), $self.serialize(), function() {
                    swal({
                        'title': 'OK',
                        'text': 'Az üzenetet sikeresen elküldtük, hamarosan válaszolunk!',
                        'type': 'success'
                    });
                    $self.slideUp(400, function () {
                        $("#contact-modal").modal("hide");
                    });
                });
            });
        });
    </script>
@endsection
