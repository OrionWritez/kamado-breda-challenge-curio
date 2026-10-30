document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menuBtn');
    const mainNav = document.getElementById('mainNav');
    
    if (menuBtn && mainNav) {
        menuBtn.addEventListener('click', function() {
            mainNav.classList.toggle('open');
            menuBtn.textContent = mainNav.classList.contains('open') ? '✕' : '☰';
        });
    }

    document.querySelectorAll('[data-email-form]').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (!form.reportValidity()) {
                return;
            }

            const formData = new FormData(form);
            const entries = Array.from(formData.entries())
                .map(([name, value]) => `${name}: ${value}`)
                .join('\n');
            const subject = form.classList.contains('feedback-form')
                ? `Feedback - ${formData.get('onderwerp')}`
                : form.classList.contains('review-form')
                    ? 'Review via de website'
                : form.closest('.contact-info')
                    ? 'Bericht via de website'
                    : 'Inschrijving masterclass';
            const email = 'Info@DeBlauweKamadoinBreda.nl';
            const mailto = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(entries)}`;
            const status = form.querySelector('.form-status');

            if (status) {
                status.textContent = form.dataset.successMessage;
            }
            window.location.href = mailto;
        });
    });

    const countryCode = document.getElementById('landcode');
    const customCountryCode = document.getElementById('andere-landcode');
    if (countryCode && customCountryCode) {
        const countryCodeDisplay = document.getElementById('landcode-weergave');
        const updateCustomCountryCode = function() {
            const needsCustomCode = countryCode.value === 'other';
            customCountryCode.hidden = !needsCustomCode;
            customCountryCode.required = needsCustomCode;
            countryCodeDisplay.textContent = needsCustomCode ? '+…' : countryCode.value;
        };

        countryCode.addEventListener('change', updateCustomCountryCode);
        updateCustomCountryCode();
    }

    const searchForm = document.getElementById('product-search');
    const productCards = Array.from(document.querySelectorAll('[data-product-card]'));
    const searchStatus = document.getElementById('product-search-status');
    if (searchForm) {
        const searchInput = searchForm.querySelector('input[name="q"]');
        const filterProducts = function() {
            const query = searchInput.value.trim().toLocaleLowerCase('nl');
            let visibleCount = 0;

            productCards.forEach(card => {
                const matches = card.textContent.toLocaleLowerCase('nl').includes(query);
                card.hidden = !matches;
                if (matches) {
                    visibleCount++;
                }
            });

            searchStatus.textContent = query && visibleCount === 0
                ? 'Geen producten gevonden. Probeer een andere zoekterm.'
                : query
                    ? `${visibleCount} ${visibleCount === 1 ? 'product' : 'producten'} gevonden.`
                    : '';
        };

        searchInput.addEventListener('input', filterProducts);
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            filterProducts();
        });
    }

    const reviewDialog = document.getElementById('review-dialog');
    if (reviewDialog) {
        document.querySelector('[data-review-open]').addEventListener('click', function() {
            reviewDialog.showModal();
        });
        reviewDialog.querySelector('[data-review-close]').addEventListener('click', function() {
            reviewDialog.close();
        });
        reviewDialog.addEventListener('click', function(event) {
            if (event.target === reviewDialog) {
                reviewDialog.close();
            }
        });
    }

    const productDialog = document.getElementById('product-dialog');
    if (productDialog) {
        document.querySelectorAll('[data-product-details]').forEach(button => {
            button.addEventListener('click', function() {
                const card = button.closest('[data-product-card]');
                productDialog.querySelector('#product-dialog-title').textContent =
                    card.querySelector('[data-product-name]').textContent;
                productDialog.querySelector('#product-dialog-price').textContent =
                    card.querySelector('.product-price').textContent;
                productDialog.querySelector('#product-dialog-stock').textContent =
                    `Op voorraad: ${button.dataset.productStock}`;
                productDialog.querySelector('#product-dialog-info').textContent =
                    button.dataset.productInfo;
                productDialog.showModal();
            });
        });

        productDialog.querySelector('[data-dialog-close]').addEventListener('click', function() {
            productDialog.close();
        });
        productDialog.addEventListener('click', function(event) {
            if (event.target === productDialog) {
                productDialog.close();
            }
        });
    }

    document.querySelectorAll('[data-slideshow]').forEach(slideshow => {
        const slides = Array.from(slideshow.querySelectorAll('img'));
        if (slides.length < 2) {
            return;
        }

        let activeIndex = slides.findIndex(slide => slide.classList.contains('is-active'));
        if (activeIndex < 0) {
            activeIndex = 0;
            slides[activeIndex].classList.add('is-active');
            slides[activeIndex].setAttribute('aria-hidden', 'false');
        }

        window.setInterval(function() {
            slides[activeIndex].classList.remove('is-active');
            slides[activeIndex].setAttribute('aria-hidden', 'true');
            activeIndex = (activeIndex + 1) % slides.length;
            slides[activeIndex].classList.add('is-active');
            slides[activeIndex].setAttribute('aria-hidden', 'false');
        }, 4000);
    });

});