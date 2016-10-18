@extends('admin')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hír szerkesztése</h3>
        </div>

        <form
            @if ($article->exists)
            action="{{ route('news.update', ['news' => $article->id]) }}"
            @else
            action="{{ route('news.store') }}"
            @endif
            method="POST"
        >

            @if ($article->exists)
                {{ method_field('PUT') }}
            @endif

            <div class="panel-body">

                @if (! $errors->isEmpty())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Hír címe</label>
                    <input type="text" name="title"
                           value="{{ $article->title }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="lead">Hír bevezetője</label>
                    <textarea name="lead" class="form-control" rows="4"
                    >{{ $article->lead }}</textarea>
                </div>

                <div class="form-group">
                    <label for="published_at">Megjelenés ideje (ÉÉÉÉ-HH-NN ÓÓ:PP)</label>
                    <input type="datetime"
                           name="published_at"
                           id="published_at"
                           class="form-control"
                           value="{{ $article->published_at->format('Y-m-d H:i') }}">
                </div>

                <div class="form-group">
                    <label for="content">Hír szövege</label>
                    <textarea name="content" class="form-control trumbowyg"
                    >{!! $article->content !!}</textarea>
                </div>
            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    Mentés
                </button>
            </div>

        </form>
    </div>
@endsection
