@extends('app', [
    'seoDescription' => $article->lead,
    'seoTitle' => $article->title,
    'seoType' => 'article'
])

@section('content')
    <div class="container" id="article">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">Főoldal</a></li>
                    <li><a href="/hirek">Hírek</a></li>
                    <li class="active">{{ $article->title }}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <article>
                    <h1>{{ $article->title }}</h1>
                    <p class="article-info">
                        @if($article->author)
                            <span class="author">
                                <img src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20" title="{{ $article->author->name }}" alt="{{ $article->author->name }}">
                                {{ $article->author->name }}
                            </span>
                            <span class="separator">&middot;</span>
                        @endif
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                            {{ $article->publication->format('Y. F j.') }}
                        </time>
                    </p>

                    <div class="social">
                        <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large" data-mobile-iframe="false">
                            <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Megosztás</a>
                        </div>
                    </div>

                    <p class="lead">
                        {{ $article->lead }}
                    </p>

                    <div class="article-contents">
                        {!! $article->content !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
