@extends('app', [
    'seoDescription' => 'A Fertőrákosi Lövészklub hírei.',
    'seoTitle' => 'Hírek'
])

@section('content')
    <div class="container" id="article">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">Főoldal</a></li>
                    <li class="active">Hírek</li>
                </ol>
            </div>
        </div>
        <div class="row">
            @forelse($articles as $article)
            <div class="col-xs-12 col-sm-4 article-box">
                <article>
                    <a href="/hirek/{{ $article->slug }}"><h1>{{ $article->title }}</h1></a>
                    <p class="article-info">
                        @if($article->author)
                            <span class="author">
                                <img
                                    src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20"
                                    title="{{ $article->author->name }}"
                                    alt="{{ $article->author->name }}">
                                {{ $article->author->name }}
                                </span>
                            <span class="separator">&middot;</span>
                        @endif
                        <time
                            datetime="{{ $article->published_at->format('Y-m-d') }}">
                            {{ $article->publication->format('Y. F j.') }}
                        </time>
                    </p>

                    <p class="intro">
                        {{ str_limit($article->lead, 250) }}
                        <br>
                        <a href="/hirek/{{ $article->slug }}">Tovább &raquo;</a>
                    </p>
                </article>
            </div>

                @if(($loop->index + 1) % 3 == 0)
                    <div class="clearfix"></div>
                @endif

            @empty
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-info">
                            Jelenleg nincs új hírünk.
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
