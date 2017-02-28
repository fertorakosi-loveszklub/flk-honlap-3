@extends('admin', [
    'title' => 'Dokumentumok'
])

@section('content')
    <h3 class="panel-title">Dokumentum szerkesztése</h3>

    <form
        @if ($document->exists)
        action="{{ route('documents.update', ['documents' => $document->id]) }}"
        @else
        action="{{ route('documents.store') }}"
        @endif
        method="POST"
        enctype="multipart/form-data"
    >

        @if ($document->exists)
            {{ method_field('PUT') }}
        @endif


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
            <label for="title">Dokumentum címe</label>
            <input type="text" name="title"
                   value="{{ $document->title }}" class="form-control">
        </div>

        @if($document->exists)
            <div class="alert alert-info">
                Csak akkor válassz ki fájlt, ha le akarod cserélni a meglévőt.
            </div>
        @endif

            <div class="file-field input-field">
                <div class="btn">
                    <span>Fájl feltöltése</span>
                    <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>


        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
            <button type="submit" class="btn-floating btn-large green">
                <i class="large material-icons">done</i>
            </button>
        </div>


    </form>
@endsection
