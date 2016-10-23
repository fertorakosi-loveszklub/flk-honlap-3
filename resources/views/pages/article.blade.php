@extends('app', [
    'seoDescription' => $article->lead,
    'seoTitle' => $article->title
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
                            <img src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20" title="{{ $article->author->name }}" alt="{{ $article->author->name }}">
                            {{ $article->author->name }}
                            @endif
                            </span>
                        <span class="separator">&middot;</span>
                        <span class="author">
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                            {{ $article->publication->format('Y. F j.') }}
                        </time>
                    </p>

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
