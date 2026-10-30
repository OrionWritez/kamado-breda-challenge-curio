<?php
$page_title = 'Home';
include 'header.php';
?>

<section class="hero">
    <div class="hero-text">
        <h1>Beste blauwe Kamado's ter wereld!</h1>
        <p>Kamado Breda is de plek voor liefhebbers van kamado barbecuers die net iets anders willen. Wij richten ons volledig op blauwe kamado's: een unieke combinatie van uitstraling, kwaliteit en barbecueplezier. Ontdek onze collectie en geef jouw tuin of buitenkeuken een bijzondere toevoeging!</p>
        <a href="over-ons.php" class="btn">Lees meer</a>
    </div>
    <div class="hero-img">
        <img src="img/front.png" alt="Hero Image">
    </div>
</section>

<section class="home-grid">
    <div class="card feedback-box">
        <h3>FEEDBACK</h3>
        <form class="feedback-form" data-email-form data-success-message="Je feedback is verstuurd naar je e-mailprogramma. Verstuur daar de e-mail om je feedback echt in te dienen.">
            <fieldset class="feedback-options">
                <legend>Waar gaat je klacht over?</legend>
                <label><input type="radio" name="onderwerp" value="Product" required> Product</label>
                <label><input type="radio" name="onderwerp" value="Bestelling"> Bestelling</label>
                <label><input type="radio" name="onderwerp" value="Bezorging"> Bezorging</label>
                <label><input type="radio" name="onderwerp" value="Service"> Service</label>
                <label><input type="radio" name="onderwerp" value="Anders"> Anders</label>
            </fieldset>
            <label class="sr-only" for="feedback-bericht">Beschrijf je klacht</label>
            <textarea id="feedback-bericht" name="bericht" rows="4" placeholder="Vertel ons wat er aan de hand is..." required></textarea>
            <button type="submit" class="btn btn-block">STUREN</button>
            <p class="form-status" role="status" aria-live="polite"></p>
        </form>
    </div>
    
    <div class="card map-box">
        <h3>Waar vind je ons?</h3>
        <div class="map-placeholder">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2477.9065157524724!2d4.77572217683317!3d51.60660147183599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c69f990d127d8b%3A0x1e825fb420ca913c!2sCurio%2C%20Terheijdenseweg%20350!5e0!3m2!1snl!2snl!4v1792144201160!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </div>
    </div>
    
    <div class="card hours-box">
        <h3>Openingstijden</h3>
        <ul class="hours-list">
            <li>Maandag: 10:00–17:00</li>
            <li>Dinsdag: 10:00–17:00</li>
            <li>Woensdag: 10:00–17:00</li>
            <li>Donderdag: 10:00–17:00</li>
            <li>Vrijdag: 10:00–17:00</li>
            <li>Zaterdag: 10:00–17:00</li>
            <li>Zondag: 10:00–17:00</li>
        </ul>
    </div>
</section>

<?php include 'footer.php'; ?>;