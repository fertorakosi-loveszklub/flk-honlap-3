@extends('app')

@section('content')
    <section id="map">
    </section>

    <section class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 pull-right">
                @include('contact-form')
            </div>

            <section class="col-xs-12 col-sm-6 col-md-7 pull-left" id="info-box">
                <h2>Hol érsz el minket?</h2>

                <h3>Elérhetőségek</h3>
                <p>
                    <strong class="info-title">Cím:</strong>
                    <span class="info-content">9421 Fertőrákos, Felsőszikla sor</span>
                </p>

                <p class="clearfix">
                    <strong class="info-title">Telefonszám:</strong>
                    <span class="info-content">(30) 38 56 603 (Fekete Zsolt)</span>
                </p>

                <h3>Edzések</h3>

                <p>
                    Edzéseinket <strong>szombatonként</strong> tartjuk,
                    nyáron 15 órakor, télen 14 órakor kezdünk. <br>
                </p>
            </section>
        </div>
    </section>
@endsection

@section('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endsection

@section('scripts')
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
                    $self.slideUp();
                });
            });
        });
    </script>

        <script>
        var map;
        function initMap() {
            var coords = {lat: 47.723931, lng: 16.642026};
            map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                zoom: 15,
                draggable: false,
                scrollwheel: false
            });

            new google.maps.Marker({
                position: coords,
                map: map,
                title: 'Fertőrákosi lőtér'
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzmfKJFUjz_x0DJNAt_mA63mZj6MH_2WU&callback=initMap"
            async defer></script>

@endsection

