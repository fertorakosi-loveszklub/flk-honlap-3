<form action="/kapcsolat" method="POST" id="contact-form">
    <h2>Írj nekünk!</h2>

    {!! Honeypot::generate('url', 'website') !!}

    {{ csrf_field() }}
    <div class="form-group">
        <label for="contact-email">E-mail címed</label>
        <input type="email" name="email" id="contact-email" class="form-control">
    </div>

    <div class="form-group">
        <label for="contact-phone">Telefonszámod (nem kötelező)</label>
        <input type="text" name="phone" id="contact-phone" class="form-control">
    </div>

    <div class="form-group">
        <label for="contact-message">Üzeneted</label>
        <textarea name="user_message" id="contact-message" class="form-control"
                  rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Küldés
    </button>
</form>
