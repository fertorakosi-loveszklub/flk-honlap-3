@extends('app', [
    'seoTitle' => 'Galéria',
    'seoDescription' => 'Képek a Fertőrákosi Lövészklub életéből'
])

@section('content')
    <div class="container" id="gallery-list">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">Főoldal</a></li>
                    <li class="active">Galéria</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-center">
                @foreach($galleries as $gallery)
                    <a class="gallery-link" href="/galeria/{{ $gallery->slug }}">
                        <img src="{{ Image::url($gallery->thumbnail_url, 300, 300, ['crop']) }}" alt="{{ $gallery->title }}">
                        <span class="title">{{ $gallery->title }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
