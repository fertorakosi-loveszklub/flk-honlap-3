@extends('admin')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Hírek</h3>
        </div>

        <div class="panel-body">
            <a href="{{ route('news.create') }}" class="btn btn-success">
                Új hír írása
            </a>
        </div>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cím</th>
                    <th class="text-center">Szerző</th>
                    <th>Közzététel dátuma</th>
                    <th>Szerkesztés</th>
                    <th>Törlés</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td class="text-center">
                            @if ($article->author)
                                <img src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20" title="{{ $article->author->name }}" alt="{{ $article->author->name }}">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $article->published_at->format('Y. m. d. H:i') }}</td>
                        <td>
                            <a href="{{ route('news.edit', ['news' => $article->id]) }}" class="btn btn-success">
                                Szerkesztés
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('news.destroy', ['news' => $article->id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
