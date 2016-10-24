@extends('admin')

@section('content')
    <h3 class="panel-title">Hír szerkesztése</h3>

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

            <div class="input-field">
                <label for="title">Hír címe</label>
                <input type="text" name="title"
                       value="{{ $article->title }}" class="form-control">
            </div>

            <div class="input-field">
                <label for="lead">Hír bevezetője</label>
                <textarea name="lead" class="materialize-textarea" rows="4"
                >{{ $article->lead }}</textarea>
            </div>


            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field">
                        <input type="text"
                               name="published_at"
                               id="published_at"
                               class="form-control"
                               value="{{ $article->published_at->format('Y-m-d H:i') }}">
                        <label for="published_at">Megjelenés ideje (ÉÉÉÉ-HH-NN
                            ÓÓ:PP)</label>

                    </div>
                </div>
            </div>

            <div class="row">+
                <div class="col s12 m6">
                    <div class="switch">
                        <label>
                            Nem látható
                            <input
                                type="checkbox"
                                name="is_visible"
                                value="1"
                                @if ($article->is_visible || !$article->exists)
                                checked
                                @endif
                            >
                            <span class="lever"></span>
                            Látható
                        </label>
                    </div>
                </div>
            </div>

            <div class="input-field">
                <label for="content">Hír szövege</label>
                <textarea name="content" class="form-control trumbowyg"
                >{!! $article->content !!}</textarea>
            </div>
        </div>

        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
            <button type="submit" class="btn-floating btn-large green">
                <i class="large material-icons">done</i>
            </button>
        </div>
    </form>
    </div>
@endsection
