@extends('app', [
    'seoTitle' => "Dokumentumok"
])

@section('content')
    <div class="container" id="document">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">Főoldal</a></li>
                    <li class="active">Dokumentumok</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h1>Dokumentumok</h1>
            </div>
        </div>

        <div id="document-list">
            @forelse($documents as $document)
                <div class="row file-row">
                    <div class="col-xs-12 col-sm-8">
                        <a href="{{ url($document->file_path) }}" target="_blank" class="text-center visible-xs">
                            {{ $document->title }}
                        </a>
                        <span class="title hidden-xs">{{ $document->title }}</span>
                    </div>
                    <div class="hidden-xs col-sm-4 text-right">
                        <a href="{{ url($document->file_path) }}" target="_blank">
                            Letöltés
                        </a>
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-info">
                            Jelenleg nincs feltöltve dokumentum.
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
