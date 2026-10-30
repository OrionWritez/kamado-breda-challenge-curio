<?php
$page_title = 'Contact';
include 'header.php';
?>

<section class="section">
    <h1 class="section-title">Contact</h1>
    
    <div class="contact-grid">
        <div class="contact-info card">
            <p><strong>E-MAIL:</strong> <a href="mailto:Info@DeBlauweKamadoinBreda.nl">Info@DeBlauweKamadoinBreda.nl</a></p>
            <p><strong>TELEFOON:</strong> <a href="tel:+3176526236">076-526236</a></p>
            <p><strong>LOCATIE:</strong> <a href="https://www.google.com/maps/dir/?api=1&amp;destination=Curio%2C%20Terheijdenseweg%20350%2C%20Breda" target="_blank" rel="noopener noreferrer">Curio, Terheijdenseweg 350, Breda</a></p>
            
            <div style="margin-top: 2rem;">
                <h3 style="color: var(--blue); margin-bottom: 1rem;">Stuur ons een bericht</h3>
                <form data-email-form data-success-message="Je e-mailprogramma wordt geopend met je bericht. Verstuur de e-mail om contact met ons op te nemen.">
                    <div class="form-group">
                        <label for="c-naam">Naam</label>
                        <input type="text" id="c-naam" name="naam" required>
                    </div>
                    <div class="form-group">
                        <label for="c-email">E-mail</label>
                        <input type="email" id="c-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="c-bericht">Bericht</label>
                        <textarea id="c-bericht" name="bericht" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn">STUREN</button>
                    <p class="form-status" role="status" aria-live="polite"></p>
                </form>
            </div>
        </div>
        
        <div class="contact-slideshow image-slideshow" data-slideshow aria-label="Kamado producten">
            <img class="is-active" src="slideshowimg/5.png" alt="Rode kamado tijdens een BBQ" aria-hidden="false">
            <img src="slideshowimg/6.png" alt="BBQ bereiden op een kamado" aria-hidden="true">
            <img src="slideshowimg/7.png" alt="Koken met een kamado" aria-hidden="true">
            <img src="slideshowimg/8.png" alt="Kamado gebruiken aan het water" aria-hidden="true">
            <span class="slideshow-brand">KAMADO BREDA</span>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>