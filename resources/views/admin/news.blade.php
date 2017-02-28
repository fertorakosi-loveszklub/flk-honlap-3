@extends('admin')

@section('content')
<h3 class="panel-title">Hírek</h3>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cím</th>
            <th class="center-align">Szerző</th>
            <th class="center-align">Látható</th>
            <th>Közzététel dátuma</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $article)
            <tr>
                <td class="hide-on-med-and-down">{{ $article->id }}</td>
                <td class="first-on-mobile">{{ $article->title }}</td>
                <td class="center-align hide-on-med-and-down">
                    @if ($article->author)
                        <img src="//graph.facebook.com/{{ $article->author->facebook_user_id }}/picture?height=20" title="{{ $article->author->name }}" alt="{{ $article->author->name }}">
                    @else
                        -
                    @endif
                </td>
                <td class="center-align">
                    @if ($article->is_visible)
                        <i class="material-icons">done</i>
                    @else
                        <i class="material-icons">close</i>
                    @endif
                </td>
                <td>{{ $article->published_at->format('Y. m. d. H:i') }}</td>
                <td>
                    <a href="{{ route('news.edit', ['news' => $article->id]) }}" class="blue darken-1 btn-floating waves-effect waves-effect">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('news.destroy', ['news' => $article->id]) }}" method="post">
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
    <a href="{{ route('news.create') }}" class="btn-floating btn-large green">
        <i class="large material-icons">add</i>
    </a>
</div>

@endsection
