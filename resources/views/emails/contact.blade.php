<h1>Fertőrákosi Lövészklub</h1>

<p>Kapcsolatfelvétel érkezett:</p>

<p><strong>Email:</strong> {{ $email }}</p>
@if (!empty($phone))
    <p><strong>Telefonszám:</strong> {{ $phone }}</p>
@endif
<p><strong>Üzenet:</strong> {!! nl2br(strip_tags($user_message)) !!}</p>
