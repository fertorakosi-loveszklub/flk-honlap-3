@extends('admin')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Galériák</h3>
        </div>

        <div class="panel-body">
            <a href="{{ route('galleries.create') }}" class="btn btn-success">
                Új galéria
            </a>
        </div>

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Cím</th>
                <th>Szerkesztés</th>
                <th>Törlés</th>
            </tr>
            </thead>
            <tbody>
            @foreach($galleries as $gallery)
                <tr>
                    <td>{{ $gallery->id }}</td>
                    <td>{{ $gallery->title }}</td>
                    <td>
                        <a href="{{ route('galleries.edit', ['galleries' => $gallery->id]) }}" class="btn btn-success">
                            Szerkesztés
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('galleries.destroy', ['galleries' => $gallery->id]) }}" method="post">
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
