@extends('admin', [
    'title' => 'Galéria'
])

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Galéria szerkesztése</h3>
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

                <div class="input-group">
                    <label for="title">Galéria címe</label>
                    <input type="text" name="title"
                           value="{{ $gallery->title }}" class="form-control">
                </div>

                <div class="input-group">
                    <label for="imgur_url">Imgur album link</label>
                    <input name="imgur_url" class="form-control"
                            value="{{ $gallery->imgur_url }}" />
                </div>

                <div class="input-group">
                    <label for="description">Galéria szövege</label>
                    <textarea name="description" class="form-control trumbowyg"
                    >{!! $gallery->description !!}</textarea>
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
