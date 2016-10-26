@extends('admin', [
    'title' => 'Oldalak'
])

@section('content')
    <h3>Oldalak</h3>

    <table class="table ">
        <thead>
        <tr>
            <th>#</th>
            <th>Cím</th>
            <th>Műveletek</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>
                    <a href="{{ route('pages.edit', ['pages' => $page->id]) }}" class="left blue darken-1 btn-floating waves-effect">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('pages.destroy', ['pages' => $page->id]) }}" class="left" method="post">
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
        <a href="{{ route('pages.create') }}" class="btn-floating btn-large green">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endsection
