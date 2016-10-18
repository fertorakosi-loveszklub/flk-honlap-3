@extends('admin')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hír szerkesztése</h3>
        </div>

        <form
            @if ($gallery->exists)
            action="{{ route('galleries.update', ['galleries' => $gallery->id]) }}"
            @else
            action="{{ route('galleries.store') }}"
            @endif
            method="POST"
        >

            @if ($gallery->exists)
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
                    <label for="title">Galéria címe</label>
                    <input type="text" name="title"
                           value="{{ $gallery->title }}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="imgur_url">Imgur album link</label>
                    <input name="imgur_url" class="form-control"
                            value="{{ $gallery->imgur_url }}" />
                </div>

                <div class="form-group">
                    <label for="description">Hír szövege</label>
                    <textarea name="description" class="form-control trumbowyg"
                    >{!! $gallery->description !!}</textarea>
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
