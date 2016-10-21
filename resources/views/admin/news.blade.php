@extends('admin')

@section('content')
<h3 class="panel-title">Hírek</h3>

<table class="table">
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
                <td class="hide-on-med-and-down">{{ $article->id }}</td>
                <td class="first-on-mobile">{{ $article->title }}</td>
                <td class="text-center hide-on-med-and-down">
                    @if ($article->author)
                        <img src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20" title="{{ $article->author->name }}" alt="{{ $article->author->name }}">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $article->published_at->format('Y. m. d. H:i') }}</td>
                <td>
                    <a href="{{ route('news.edit', ['news' => $article->id]) }}" class="btn waves-effect">
                        Szerkesztés
                    </a>
                </td>
                <td>
                    <form action="{{ route('news.destroy', ['news' => $article->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn waves-effect red darken-4">
                            Törlés
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
