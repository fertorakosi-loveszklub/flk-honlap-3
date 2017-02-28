@extends('admin', [
    'title' => 'Galéria'
])

@section('content')
    <h3>Galériák</h3>

    <table class="table ">
        <thead>
        <tr>
            <th>#</th>
            <th>Cím</th>
            <th>Műveletek</th>
        </tr>
        </thead>
        <tbody>
        @foreach($galleries as $gallery)
            <tr>
                <td>{{ $gallery->id }}</td>
                <td>{{ $gallery->title }}</td>
                <td>
                    <a href="{{ route('galleries.edit', ['galleries' => $gallery->id]) }}" class="blue darken-1 btn-floating waves-effect">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('galleries.destroy', ['galleries' => $gallery->id]) }}" method="post">
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
        <a href="{{ route('galleries.create') }}" class="btn-floating btn-large green">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endsection
