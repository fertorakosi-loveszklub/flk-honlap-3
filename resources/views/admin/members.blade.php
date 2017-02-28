@extends('admin', [
    'title' => 'Tagok'
])

@section('content')
    <h3>Tagok</h3>

    <table class="table ">
        <thead>
        <tr>
            <th>Ig. sz.</th>
            <th>Név</th>
            <th>Szül.</th>
            <th>Műveletek</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->card_id }}</td>
                <td>
                    {{ $member->name }}
                </td>
                <td>
                    {{ $member->birth_place }}, {{ $member->born_at->format('Y. m. d.') }}
                </td>
                <td>
                    <a href="{{ route('members.edit', ['members' => $member->id]) }}" class="left blue darken-1 btn-floating waves-effect">
                        <i class="material-icons">edit</i>
                    </a>
                    <form action="{{ route('members.destroy', ['members' => $member->id]) }}" class="left" method="post">
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
        <a href="{{ route('members.create') }}" class="btn-floating btn-large green">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endsection
