@extends('admin', [
    'title' => 'Tagok'
])


@section('content')
    <h3 class="panel-title">Tag szerkesztése</h3>

    <form
        @if ($member->exists)
        action="{{ route('members.update', ['members' => $member->id]) }}"
        @else
        action="{{ route('members.store') }}"
        @endif
        method="POST"
        enctype="multipart/form-data"
    >

        @if ($member->exists)
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
            <label for="name">Név</label>
            <input type="text" name="name"
                   value="{{ old('name', $member->name) }}" class="form-control">
        </div>

        <div class="input-group">
            <label for="born_at">Szül. dátum (ÉÉÉÉ-HH-NN)</label>
            <input type="text" name="born_at"
                   @if ($member->exists) value="{{ old('born_at', $member->born_at->format('Y-m-d')) }}"
                   @else value="{{ old('born_at', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                   @endif
                   class="form-control">
        </div>

        <div class="input-group">
            <label for="birth_place">Szül. hely</label>
            <input type="text" name="birth_place"
                   value="{{ old('birth_place', $member->birth_place) }}" class="form-control">
        </div>

        <div class="input-group">
            <label for="birth_place">Anyja neve</label>
            <input type="text" name="mother_name"
                   value="{{ old('mother_name', $member->mother_name) }}" class="form-control">
        </div>

        <div class="input-group">
            <label for="address">Lakcím</label>
            <input type="text" name="address"
                   value="{{ old('address', $member->address) }}" class="form-control">
        </div>

        <div class="input-group">
            <label for="joined_at">Tagság kezdete (ÉÉÉÉ-HH-NN)</label>
            <input type="text" name="joined_at"
                   @if ($member->exists) value="{{ old('joined_at', $member->joined_at->format('Y-m-d')) }}"
                   @else value="{{ old('joined_at', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                   @endif
                   class="form-control">
        </div>

        <div class="input-group">
            <label for="card_id">Tagsági szám</label>
            <input type="text" name="card_id" value="{{ old('card_id', $member->card_id) }}"
                   placeholder="Következő: {{ \App\MemberProfile::max('card_id') + 1 }}"
                   class="form-control">
        </div>

        <div class="input-group">
            <label for="phone">Telefon</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $member->phone) }}" class="form-control">
        </div>

        <div class="input-group">
            <label for="email">E-mail</label>
            <input type="text" name="email"
                   value="{{ old('email', $member->email) }}" class="form-control">
        </div>




        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <button type="submit" class="btn-floating btn-large green">
            <i class="large material-icons">done</i>
        </button>
        </div>


    </form>
@endsection
