@extends('admin', [
    'title' => 'Dokumentumok'
])

@section('content')
    <h3>Dokumentumok</h3>

    <table class="table ">
        <thead>
        <tr>
            <th>#</th>
            <th>Cím</th>
            <th>Műveletek</th>
        </tr>
        </thead>
        <tbody>
        @foreach($documents as $document)
            <tr>
                <td>{{ $document->id }}</td>
                <td>
                    <a target="_blank" href="{{ url($document->file_path) }}">
                        {{ $document->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('documents.edit', ['documents' => $document->id]) }}" class="blue darken-1 btn-floating waves-effect">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('documents.destroy', ['documents' => $document->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn-floating waves-effect red darken-1">
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a href="{{ route('documents.create') }}" class="btn-floating btn-large green">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endsection
