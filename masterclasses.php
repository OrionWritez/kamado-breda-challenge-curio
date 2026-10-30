<?php
$page_title = 'Master Classes';
session_start();
$reviews_file = __DIR__ . '/reviews.json';
$reviews = [];
$review_notice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_action'] ?? '') === 'submit_review') {
    $review_name = trim((string) ($_POST['naam'] ?? ''));
    $review_rating = filter_input(INPUT_POST, 'beoordeling', FILTER_VALIDATE_INT);
    $review_text = trim((string) ($_POST['review'] ?? ''));

    if ($review_name === '' || strlen($review_name) > 100 || $review_rating === false || $review_rating < 1 || $review_rating > 5 || $review_text === '' || strlen($review_text) > 2000) {
        $review_notice = 'Controleer je naam, beoordeling en review. Een review mag maximaal 2000 tekens bevatten.';
    } else {
        $reviews_handle = fopen($reviews_file, 'c+');
        if ($reviews_handle && flock($reviews_handle, LOCK_EX)) {
            $stored_reviews = json_decode(stream_get_contents($reviews_handle), true);
            if (!is_array($stored_reviews)) {
                $stored_reviews = [];
            }

            array_unshift($stored_reviews, [
                'name' => $review_name,
                'rating' => $review_rating,
                'text' => $review_text,
                'date' => date('Y-m-d'),
            ]);
            $reviews_json = json_encode($stored_reviews, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            rewind($reviews_handle);
            $saved = $reviews_json !== false
                && ftruncate($reviews_handle, 0)
                && fwrite($reviews_handle, $reviews_json) === strlen($reviews_json)
                && fflush($reviews_handle);
            flock($reviews_handle, LOCK_UN);
            fclose($reviews_handle);

            if ($saved) {
                $_SESSION['review_notice'] = 'Bedankt, je review is opgeslagen.';
                header('Location: masterclasses.php#reviews');
                exit;
            }
        } elseif ($reviews_handle) {
            fclose($reviews_handle);
        }

        $review_notice = 'Je review kon niet worden opgeslagen. Probeer het later opnieuw.';
    }
}

if (is_file($reviews_file)) {
    $stored_reviews = json_decode(file_get_contents($reviews_file), true);
    if (is_array($stored_reviews)) {
        $reviews = $stored_reviews;
    }
}

if (isset($_SESSION['review_notice'])) {
    $review_notice = $_SESSION['review_notice'];
    unset($_SESSION['review_notice']);
}

include 'header.php';
?>

<section class="section">
    <div class="master-header">
        <h1>MASTERCLASSES</h1>
    </div>
    
    <div class="master-grid">
        <div class="card form-section">
            <form data-email-form data-success-message="Ingeschreven! Verstuur de klaargezette e-mail om je inschrijving bij Kamado Breda te bevestigen.">
                <div class="form-group">
                    <label for="naam">Naam</label>
                    <input type="text" id="naam" name="naam" required>
                </div>
                <div class="form-group">
                    <label for="achternaam">Achternaam</label>
                    <input type="text" id="achternaam" name="achternaam" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefoon">Telefoon nummer</label>
                    <div class="phone-input">
                        <div class="country-code-select">
                            <span id="landcode-weergave" aria-hidden="true">+31</span>
                            <label class="sr-only" for="landcode">Landcode</label>
                            <select id="landcode" name="landcode" aria-label="Landcode">
                                <option value="+31" selected>Nederland (+31)</option>
                                <option value="+32">Belgie (+32)</option>
                                <option value="+49">Duitsland (+49)</option>
                                <option value="+33">Frankrijk (+33)</option>
                                <option value="+44">Verenigd Koninkrijk (+44)</option>
                                <option value="+1">Verenigde Staten/Canada (+1)</option>
                                <option value="+34">Spanje (+34)</option>
                                <option value="+39">Italie (+39)</option>
                                <option value="+351">Portugal (+351)</option>
                                <option value="+41">Zwitserland (+41)</option>
                                <option value="+43">Oostenrijk (+43)</option>
                                <option value="+45">Denemarken (+45)</option>
                                <option value="+46">Zweden (+46)</option>
                                <option value="+47">Noorwegen (+47)</option>
                                <option value="+48">Polen (+48)</option>
                                <option value="+30">Griekenland (+30)</option>
                                <option value="+90">Turkije (+90)</option>
                                <option value="+353">Ierland (+353)</option>
                                <option value="+61">Australie (+61)</option>
                                <option value="+64">Nieuw-Zeeland (+64)</option>
                                <option value="+52">Mexico (+52)</option>
                                <option value="+55">Brazilie (+55)</option>
                                <option value="+27">Zuid-Afrika (+27)</option>
                                <option value="+86">China (+86)</option>
                                <option value="+91">India (+91)</option>
                                <option value="+81">Japan (+81)</option>
                                <option value="+971">Verenigde Arabische Emiraten (+971)</option>
                                <option value="other">Ander land...</option>
                            </select>
                        </div>
                        <label class="sr-only" for="andere-landcode">Voer je landcode in</label>
                        <input type="tel" id="andere-landcode" name="andere_landcode" placeholder="+landcode" pattern="\+[0-9]{1,4}" hidden>
                        <input type="tel" id="telefoon" name="telefoon" autocomplete="tel-national" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-block mt-2">STUREN</button>
                <p class="form-status" role="status" aria-live="polite"></p>
            </form>
        </div>
        
        <div class="slideshow-box image-slideshow" data-slideshow aria-label="Kamado's in de masterclass">
            <img class="is-active" src="slideshowimg/1.png" alt="Kamado met gegrilde gerechten" aria-hidden="false">
            <img src="slideshowimg/2.png" alt="Hamburgers op de kamado" aria-hidden="true">
            <img src="slideshowimg/3.png" alt="BBQ-masterclass met kamado" aria-hidden="true">
            <img src="slideshowimg/4.png" alt="Gerecht bereiden op de kamado" aria-hidden="true">
        </div>
        
        <div class="card reviews-box" id="reviews">
            <h3>Reviews</h3>
            <?php if ($review_notice !== ''): ?>
                <p class="form-status" role="status" aria-live="polite"><?php echo htmlspecialchars($review_notice, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <div class="reviews-list" aria-label="Ingezonden reviews" tabindex="0">
                <?php if ($reviews === []): ?>
                    <p class="reviews-empty">Er zijn nog geen reviews.</p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <?php
                        $rating = (int) ($review['rating'] ?? 0);
                        if ($rating < 1 || $rating > 5) {
                            continue;
                        }
                        ?>
                        <article class="review-item">
                            <div class="stars" aria-label="<?php echo $rating; ?> van de 5 sterren"><?php echo str_repeat('★', $rating) . str_repeat('☆', 5 - $rating); ?></div>
                            <p><?php echo nl2br(htmlspecialchars((string) ($review['text'] ?? ''), ENT_QUOTES, 'UTF-8')); ?></p>
                            <p class="review-author"><?php echo htmlspecialchars((string) ($review['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?><?php if (!empty($review['date'])): ?> · <?php echo htmlspecialchars((string) $review['date'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?></p>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="button" class="btn btn-outline btn-block mt-2" data-review-open>Stuur je review</button>
        </div>
    </div>

    <dialog class="review-dialog" id="review-dialog" aria-labelledby="review-dialog-title">
        <button type="button" class="dialog-close" data-review-close aria-label="Sluiten">&times;</button>
        <h2 id="review-dialog-title">Deel je review</h2>
        <form class="review-form" method="post">
            <input type="hidden" name="form_action" value="submit_review">
            <div class="form-group">
                <label for="review-naam">Naam</label>
                <input type="text" id="review-naam" name="naam" required>
            </div>
            <div class="form-group">
                <label for="review-beoordeling">Beoordeling</label>
                <select id="review-beoordeling" name="beoordeling" required>
                    <option value="">Kies sterren</option>
                    <option value="5">5 sterren</option>
                    <option value="4">4 sterren</option>
                    <option value="3">3 sterren</option>
                    <option value="2">2 sterren</option>
                    <option value="1">1 ster</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review-bericht">Je review</label>
                <textarea id="review-bericht" name="review" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-block">Review versturen</button>
            <p class="form-status" role="status" aria-live="polite"></p>
        </form>
    </dialog>
    
    <div class="card faq-box mt-2" style="margin-top: 2rem;">
        <h3>Veelgestelde vragen over masterclasses</h3>
        <div class="faq-grid">
            <details class="faq-item">
                <summary>Welke masterclasses bieden jullie aan?</summary>
                <p>Wij bieden verschillende BBQ-masterclasses aan, zoals een beginnersmasterclass, een vleesmasterclass, een vismasterclass en een masterclass slow cooking.</p>
            </details>
            <details class="faq-item">
                <summary>Hoelang duurt een masterclass?</summary>
                <p>Een masterclass duurt gemiddeld 3 tot 4 uur, afhankelijk van het onderwerp en de gerechten die worden bereid.</p>
            </details>
            <details class="faq-item">
                <summary>Heb ik ervaring nodig om mee te doen?</summary>
                <p>Nee, onze masterclasses zijn geschikt voor zowel beginners als ervaren BBQ-liefhebbers.</p>
            </details>
            <details class="faq-item">
                <summary>Wat leer ik tijdens een masterclass?</summary>
                <p>Je leert hoe je een kamado aansteekt, de temperatuur regelt en verschillende gerechten bereidt. Ook leer je technieken zoals grillen, roken en slow cooking.</p>
            </details>
            <details class="faq-item">
                <summary>Mag ik zelf gerechten bereiden tijdens de masterclass?</summary>
                <p>Ja, tijdens onze masterclasses ga je zelf aan de slag met het bereiden van verschillende gerechten onder begeleiding van een BBQ-expert.</p>
            </details>
            <details class="faq-item">
                <summary>Kan ik het eten na de masterclass opeten?</summary>
                <p>Ja! Alle gerechten die tijdens de masterclass worden bereid, worden gezamenlijk geproefd en opgegeten.</p>
            </details>
            <details class="faq-item">
                <summary>Hoeveel personen kunnen deelnemen aan een masterclass?</summary>
                <p>Onze masterclasses worden gegeven in kleine groepen van ongeveer 8 tot 12 personen, zodat iedereen voldoende persoonlijke begeleiding krijgt.</p>
            </details>
            <details class="faq-item">
                <summary>Wat kost een masterclass?</summary>
                <p>De prijzen beginnen vanaf €79 per persoon. Dit is inclusief ingrediënten, materialen en begeleiding.</p>
            </details>
            <details class="faq-item">
                <summary>Zijn alle ingrediënten inbegrepen bij de masterclass?</summary>
                <p>Ja, alle ingrediënten en materialen die je nodig hebt tijdens de masterclass zijn inbegrepen in de prijs.</p>
            </details>
            <details class="faq-item">
                <summary>Kan ik samen met vrienden een masterclass volgen?</summary>
                <p>Ja, je kunt je samen met vrienden of familie aanmelden. Ook is het mogelijk om een privé-masterclass voor een groep te boeken.</p>
            </details>
            <details class="faq-item">
                <summary>Wat moet ik meenemen naar de masterclass?</summary>
                <p>Je hoeft zelf niets mee te nemen. Wij verzorgen alle ingrediënten, BBQ's en benodigde materialen.</p>
            </details>
            <details class="faq-item">
                <summary>Krijg ik de recepten mee naar huis?</summary>
                <p>Ja, na afloop ontvang je de recepten van de gerechten die je tijdens de masterclass hebt gemaakt, zodat je deze thuis opnieuw kunt bereiden.</p>
            </details>
            <details class="faq-item">
                <summary>Zijn de masterclasses ook geschikt voor vegetariërs?</summary>
                <p>Ja, bij sommige masterclasses bieden wij vegetarische gerechten aan. Geef je dieetwensen vooraf door.</p>
            </details>
            <details class="faq-item">
                <summary>Hoe kan ik mij aanmelden voor een masterclass?</summary>
                <p>Je kunt je aanmelden via onze website door een masterclass en een beschikbare datum te kiezen.</p>
            </details>
            <details class="faq-item">
                <summary>Kan ik meerdere masterclasses volgen?</summary>
                <p>Ja, je kunt verschillende masterclasses volgen om steeds nieuwe BBQ-technieken en gerechten te leren.</p>
            </details>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>