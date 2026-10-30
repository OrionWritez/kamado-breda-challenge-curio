<?php
$page_title = 'Producten';
include 'header.php';
?>

<section class="section">
    <div class="card mb-2" style="padding: 1.5rem;">
        <p style="color: var(--text-secondary); margin-bottom: 1rem;">Zoek in ons productoverzicht.</p>
        
        <form class="search-bar" id="product-search">
            <input type="search" name="q" placeholder="ZOEKEN" aria-label="Zoek een product">
            <button type="submit">🔍</button>
        </form>
        <p class="form-status" id="product-search-status" role="status" aria-live="polite"></p>
    </div>
    
    <div class="products-grid">
        <?php
        $products = [
            ['name' => 'Kamado Compact', 'desc' => 'Een compacte kamado voor kleinere ruimtes.', 'price' => '449,00', 'image' => 'compact.png', 'stock' => 4, 'info' => 'Deze kamado is bedoeld voor wie graag buiten kookt maar niet veel ruimte heeft. Gebruik hem voor grillen, roken en langzaam garen. Het compacte formaat past goed op een balkon of in een kleinere tuin.'],
            ['name' => 'Kamado Classic', 'desc' => 'Een veelzijdige kamado voor uiteenlopende gerechten.', 'price' => '999,00', 'image' => 'classic.png', 'stock' => 7, 'info' => 'Met deze veelzijdige kamado bereid je allerlei gerechten op één BBQ. Grill bijvoorbeeld vlees en groenten, rook ingrediënten of gaar een gerecht langzaam. Een praktische keuze voor regelmatig gebruik met familie of vrienden.'],
            ['name' => 'Kamado Large', 'desc' => 'Een ruimere kamado voor koken voor gezelschap.', 'price' => '1.199,00', 'image' => 'large.png', 'stock' => 3, 'info' => 'Het ruimere kookoppervlak biedt meer plek om voor meerdere mensen te koken. Bereid verschillende ingrediënten naast elkaar of maak een grotere maaltijd voor familie en gasten. Geschikt voor grillen en langere bereidingen.'],
            ['name' => 'Kamado XL', 'desc' => 'Een extra ruime kamado voor grotere gezelschappen.', 'price' => '1.399,00', 'image' => 'xl.png', 'stock' => 2, 'info' => 'Deze extra ruime kamado is handig wanneer je voor een grotere groep kookt. Er is meer plek om meerdere ingrediënten of gerechten tegelijk te bereiden. Gebruik hem voor een uitgebreide BBQ, van grillen tot langzaam garen.'],
            ['name' => 'Kamado Mini', 'desc' => 'Een compacte kamado voor op tafel, balkon of onderweg.', 'price' => '249,00', 'image' => 'mini.png', 'stock' => 5, 'info' => 'Door het kleine formaat is deze kamado geschikt voor een beperkte buitenruimte of om mee te nemen. Je kunt er kleine porties op grillen en gerechten bereiden zonder een grote BBQ neer te zetten. Een compacte optie voor een balkon, picknick of camping.'],
            ['name' => 'Houtskool', 'desc' => 'Houtskool voor gebruik in je kamado.', 'price' => '34,95', 'image' => 'kool.png', 'stock' => 12, 'info' => 'Deze houtskool gebruik je als brandstof in je kamado. Vul de vuurhaard voor je BBQ-sessie en steek de houtskool aan met aanmaakmateriaal. Bewaar de zak op een droge plek, zodat de houtskool klaar is voor de volgende keer.'],
            ['name' => 'Aanmaakwokkels', 'desc' => 'Natuurlijke aanmaakblokjes om je houtskool aan te steken.', 'price' => '12,49', 'image' => 'aanmaak.png', 'stock' => 9, 'info' => 'Leg een aanmaakwokkel tussen de houtskool en steek deze aan om je BBQ op gang te helpen. Je hebt geen aanmaakvloeistof nodig. Handig om bij je houtskool te bewaren, zodat je alles voor het aansteken bij de hand hebt.'],
            ['name' => 'Pizzasteen', 'desc' => 'Bak pizza en brood met een knapperige bodem op je kamado.', 'price' => '39,95', 'image' => 'steen.png', 'stock' => 6, 'info' => 'Met deze steen bak je pizza of brood op je kamado. Laat de steen rustig mee opwarmen voordat je het deeg erop legt; zo gaart de bodem gelijkmatiger. Ook lekker voor platbrood of andere baksels.'],
            ['name' => 'Plate setter', 'desc' => 'Kook indirect en verdeel de warmte in je kamado.', 'price' => '49,95', 'image' => 'setter.png', 'stock' => 3, 'info' => 'De plate setter vormt een hitteschild tussen de houtskool en je gerecht. Daardoor kun je indirect koken, zonder dat het eten direct boven de hitte ligt. Gebruik hem bijvoorbeeld voor langzaam garen of om te bakken.'],
            ['name' => 'Gietijzeren rooster', 'desc' => 'Geef vlees en groenten een krachtige grillsmaak.', 'price' => '59,00', 'image' => 'giet.png', 'stock' => 4, 'info' => 'Dit rooster is bedoeld om ingrediënten direct boven de hitte te grillen. Het gietijzer houdt warmte vast en helpt vlees en groenten mooi dicht te schroeien. Laat het rooster na gebruik afkoelen en maak het schoon voor de volgende BBQ.'],
            ['name' => 'Druippan', 'desc' => 'Vang sappen op tijdens indirect koken en low-and-slow bereidingen.', 'price' => '31,99', 'image' => 'duip.png', 'stock' => 8, 'info' => 'Zet de druippan onder het gerecht om vet en vleessappen op te vangen tijdens het bereiden. Dat is handig bij indirect koken en lange BBQ-sessies. De pan helpt ook om je kamado schoon te houden.'],
            ['name' => 'Beschermhoes', 'desc' => 'Bescherm je kamado tegen regen en vuil.', 'price' => '34,95', 'image' => 'image.png', 'stock' => 5, 'info' => 'Bedek je kamado met deze hoes wanneer je hem niet gebruikt. Zo bescherm je de buitenkant tegen regen, stof en vuil. Haal de hoes weg voordat je de kamado aansteekt.'],
        ];
        foreach ($products as $p):
        ?>
        <article class="product-card" data-product-card>
            <div class="product-image-frame">
                <?php if (is_file(__DIR__ . '/img/' . $p['image'])): ?>
                <img class="product-img<?php echo $p['image'] === 'xl.png' ? ' product-img-xl' : ''; ?>" src="img/<?php echo htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8'); ?>?v=<?php echo filemtime(__DIR__ . '/img/' . $p['image']); ?>" alt="<?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="product-info">
                <h3 data-product-name><?php echo htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p data-product-description><?php echo htmlspecialchars($p['desc'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="product-price">€ <?php echo htmlspecialchars($p['price'], ENT_QUOTES, 'UTF-8'); ?></div>
                <button type="button" class="product-link" data-product-details data-product-stock="<?php echo htmlspecialchars((string) $p['stock'], ENT_QUOTES, 'UTF-8'); ?>" data-product-info="<?php echo htmlspecialchars($p['info'], ENT_QUOTES, 'UTF-8'); ?>">Meer over het product &gt;</button>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <dialog class="product-dialog" id="product-dialog" aria-labelledby="product-dialog-title">
        <button type="button" class="dialog-close" data-dialog-close aria-label="Sluiten">&times;</button>
        <h2 id="product-dialog-title"></h2>
        <p class="product-price" id="product-dialog-price"></p>
        <p class="product-stock" id="product-dialog-stock"></p>
        <p id="product-dialog-info"></p>
    </dialog>
</section>

<?php include 'footer.php'; ?>