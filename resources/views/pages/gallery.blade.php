@extends('app', [
    'seoDescription' => $gallery->description,
    'seoTitle' => $gallery->title,
    'seoImage' => $gallery->cover_image_url
])

@section('content')
<div class="container" id="gallery">
    <div class="row">
        <div class="col-xs-12">
            <ol class="breadcrumb">
                <li><a href="/">Főoldal</a></li>
                <li><a href="/galeria">Galéria</a></li>
                <li class="active">{{ $gallery->title }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1>{{ $gallery->title }}</h1>

            <p class="lead">
                {{ $gallery->description }}
            </p>

            <div id="gallery-images">
                @foreach($images as $image)
                    <a href="//i.imgur.com/{{ $image->getId() }}.jpg" class="gallery-item">
                        <img src="//i.imgur.com//{{ $image->getId() }}m.jpg" alt="{{ $image->getTitle() }}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/jquery.justifiedGallery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.0/baguetteBox.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#gallery-images").justifiedGallery({
                border: 0,
                margins: 10
            });

            baguetteBox.run('#gallery-images', {
                captions: function(element) {
                    return element.getElementsByTagName('img')[0].alt;
                }
            });
        });
    </script>
@endsection

@section('headers')
    <link rel="stylesheet" href="/css/justifiedGallery.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.0/baguetteBox.min.css" />
@endsection
