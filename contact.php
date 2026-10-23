<?php
$pageTitle = 'Contact';
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $fullName = sanitize($_POST['full_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $subject = sanitize($_POST['subject'] ?? '');
    $message = sanitize($_POST['message'] ?? '');

    if ($fullName !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) && $message !== '') {
        flash('success', 'Your message has been sent successfully. Our team will get back to you shortly.');
    } else {
        flash('error', 'Please provide a valid name, email, and message.');
    }
    redirect('contact.php');
}
?>
<section class="page-hero inner-page-hero">
    <div class="container small-container">
        <span class="eyebrow">Let's talk</span>
        <h1>Contact our team</h1>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div class="contact-card">
            <h3>Get in touch</h3>
            <div class="contact-item"><i class="fa fa-phone"></i><span>+254 014 2843509</span></div>
            <div class="contact-item"><i class="fa fa-envelope"></i><span>hello@clainextech.com</span></div>
            <div class="contact-item"><i class="fa fa-clock"></i><span>Business hours: 24/7</span></div>
            <div class="contact-item"><i class="fa fa-map-marker-alt"></i><span>Nairobi, Kenya</span></div>

            <div class="social-links">
                <a href="#"><i class="fa fa-facebook-f"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin-in"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div>

        <div class="contact-form-card">
            <form method="post" action="<?= BASE_URL ?>/contact.php" class="contact-form">
                <input type="hidden" name="contact_submit" value="1">
                <div class="form-row">
                    <label>
                        Full Name
                        <input type="text" name="full_name" required>
                    </label>
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        Phone Number
                        <input type="tel" name="phone">
                    </label>
                    <label>
                        Subject
                        <input type="text" name="subject">
                    </label>
                </div>
                <label>
                    Message
                    <textarea name="message" rows="6" required></textarea>
                </label>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</section>

<section class="section light-section">
    <div class="container map-box">
        <div class="map-placeholder">
            <i class="fa fa-map-marked-alt"></i>
            <p>Map view placeholder: Nairobi, Kenya</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">FAQ</span>
            <h2>Common questions</h2>
        </div>

        <div class="faq-list">
            <div class="faq-item active">
                <button class="faq-question">How fast can I get a consultation?<span>+</span></button>
                <div class="faq-answer">We usually respond within 24 hours and schedule a discovery session quickly based on your needs.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Do you support custom projects?<span>+</span></button>
                <div class="faq-answer">Yes. We design tailored solutions for software, security, cloud, AI, and analytics needs.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question">Can you support long-term maintenance?<span>+</span></button>
                <div class="faq-answer">Absolutely. We offer support, monitoring, optimization, and continuous improvement services.</div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
