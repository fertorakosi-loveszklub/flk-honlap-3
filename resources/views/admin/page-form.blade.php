@extends('admin')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Oldal szerkesztése</h3>
        </div>

        <form
            @if ($page->exists)
            action="{{ route('pages.update', ['pages' => $page->id]) }}"
            @else
            action="{{ route('pages.store') }}"
            @endif
            method="POST"
        >

            @if ($page->exists)
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

                <div class="input-group">
                    <label for="title">Oldal címe</label>
                    <input type="text" name="title"
                           value="{{ $page->title }}" class="form-control">
                </div>

                <div class="input-group">
                    <label for="slug">Azonosító</label>
                    <input name="slug" class="form-control"
                           value="{{ $page->slug }}" />
                </div>

                <div class="input-group">
                    <label for="content">Tartalom</label>
                    <textarea name="content" class="form-control trumbowyg"
                    >{!! $page->content !!}</textarea>
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
