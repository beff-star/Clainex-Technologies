document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            mainNav.classList.toggle('mobile-open');
            const expanded = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', String(!expanded));
        });
    }

    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach((item) => {
        const button = item.querySelector('.faq-question');
        if (button) {
            button.addEventListener('click', function () {
                const isOpen = item.classList.contains('active');
                faqItems.forEach((faq) => faq.classList.remove('active'));
                if (!isOpen) {
                    item.classList.add('active');
                }
            });
        }
    });

    const toast = document.querySelector('.toast');
    if (toast) {
        setTimeout(() => {
            toast.style.display = 'none';
        }, 4000);
    }

    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
    }

    document.querySelectorAll('.newsletter-form').forEach((form) => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            alert('Thank you for subscribing to Clainex updates.');
            form.reset();
        });
    });
});
