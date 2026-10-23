<?php
$pageTitle = 'Home';
require_once __DIR__ . '/includes/header.php';

$services = serviceCatalog();
?>
<section class="hero-section">
    <div class="container hero-grid">
        <div class="hero-content">
            <span class="eyebrow">Technology that moves businesses forward</span>
            <h1>Turning Ideas Into <span>Digital Solutions</span></h1>
            <p>Clainex Technologies helps organizations design, build, secure, and scale digital products that improve customer experiences and drive measurable growth.</p>
            <div class="hero-actions">
                <a href="<?= BASE_URL ?>/request.php" class="btn btn-primary">Request a Quote</a>
                <a href="<?= BASE_URL ?>/about.php" class="btn btn-secondary">Learn More</a>
            </div>
            <ul class="hero-meta">
                <li><i class="fa fa-check"></i> Scalable digital solutions</li>
                <li><i class="fa fa-check"></i> Secure-by-design systems</li>
                <li><i class="fa fa-check"></i> 24/7 responsive support</li>
            </ul>
        </div>

        <div class="hero-visual">
            <div class="service-card floating-card">
                <div class="card-top">
                    <span>Business growth</span>
                    <i class="fa fa-arrow-up-right-dots"></i>
                </div>
                <h3>+178%</h3>
                <p>Efficiency gains after digital transformation</p>
            </div>
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Team collaborating on digital strategy" />
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Featured Services</span>
            <h2>Powerful solutions for modern organizations</h2>
        </div>

        <div class="card-grid service-grid">
            <?php foreach (array_slice($services, 0, 6) as $service): ?>
                <article class="service-card">
                    <div class="service-image-wrap">
                        <img src="<?= e($service['image']) ?>" alt="<?= e($service['name']) ?>" loading="lazy">
                        <span class="service-badge"><?= e($service['badge']) ?></span>
                    </div>
                    <div class="service-body">
                        <span class="category-tag"><?= e($service['category']) ?></span>
                        <h3><?= e($service['name']) ?></h3>
                        <p><?= e($service['description']) ?></p>
                        <div class="service-meta">
                            <strong>KSh <?= number_format($service['price'], 0) ?></strong>
                            <a href="<?= BASE_URL ?>/request.php?service=<?= (int) $service['id'] ?>" class="link-btn">Get quote</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section light-section">
    <div class="container two-column">
        <div>
            <span class="eyebrow">Why choose us</span>
            <h2>Technology partners you can trust</h2>
            <ul class="feature-list">
                <li><i class="fa fa-check-circle"></i> Experienced team with strategic and technical depth</li>
                <li><i class="fa fa-check-circle"></i> Secure systems designed for business continuity</li>
                <li><i class="fa fa-check-circle"></i> Transparent communication, reliable delivery, and support</li>
                <li><i class="fa fa-check-circle"></i> Scalable solutions tailored to your business goals</li>
            </ul>
        </div>

        <div class="info-panel">
            <div class="info-box">
                <i class="fa fa-shield-alt"></i>
                <div>
                    <h4>Secure systems</h4>
                    <p>Built with security best practices and resilience in mind.</p>
                </div>
            </div>
            <div class="info-box">
                <i class="fa fa-rocket"></i>
                <div>
                    <h4>Fast implementation</h4>
                    <p>Launch products and services with a clear execution roadmap.</p>
                </div>
            </div>
            <div class="info-box">
                <i class="fa fa-chart-line"></i>
                <div>
                    <h4>Data-driven decisions</h4>
                    <p>Turn insights into opportunities with analytics and optimization.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container stats-grid">
        <div class="stat-box">
            <strong>120+</strong>
            <span>Projects delivered</span>
        </div>
        <div class="stat-box">
            <strong>18+</strong>
            <span>Industry specialists</span>
        </div>
        <div class="stat-box">
            <strong>97%</strong>
            <span>Client retention</span>
        </div>
        <div class="stat-box">
            <strong>24/7</strong>
            <span>Support coverage</span>
        </div>
    </div>
</section>

<section class="section light-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">What our clients say</span>
            <h2>Trust built through results</h2>
        </div>

        <div class="testimonial-grid">
            <article class="testimonial">
                <div class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                <p>“Clainex helped us modernize our systems and improved our operational efficiency within weeks.”</p>
                <div class="person">
                    <strong>Jane W.</strong>
                    <span>Operations Director</span>
                </div>
            </article>
            <article class="testimonial">
                <div class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                <p>“Their cybersecurity review gave us more clarity and confidence in our infrastructure risk posture.”</p>
                <div class="person">
                    <strong>David M.</strong>
                    <span>IT Manager</span>
                </div>
            </article>
            <article class="testimonial">
                <div class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                <p>“The team delivered a custom analytics dashboard that helped us forecast and improve decisions.”</p>
                <div class="person">
                    <strong>Aisha K.</strong>
                    <span>Business Analyst</span>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Latest insights</span>
            <h2>Fresh ideas from our blog</h2>
        </div>

        <div class="blog-grid">
            <article class="blog-card">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=900&q=80" alt="Analytics dashboard" loading="lazy">
                <div class="blog-body">
                    <span>Data Strategy</span>
                    <h3>How modern analytics create smarter business decisions</h3>
                    <a href="#">Read more</a>
                </div>
            </article>
            <article class="blog-card">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80" alt="Cybersecurity discussion" loading="lazy">
                <div class="blog-body">
                    <span>Cyber Security</span>
                    <h3>Three ways to strengthen your digital security posture</h3>
                    <a href="#">Read more</a>
                </div>
            </article>
            <article class="blog-card">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Cloud transformation" loading="lazy">
                <div class="blog-body">
                    <span>Cloud</span>
                    <h3>Why cloud-first strategies are essential for digital growth</h3>
                    <a href="#">Read more</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="newsletter-section">
    <div class="container newsletter-box">
        <div>
            <span class="eyebrow">Stay connected</span>
            <h2>Get technology insights and updates</h2>
        </div>
        <form class="newsletter-form" method="post" action="#">
            <input type="email" name="newsletter_email" placeholder="Enter your email" aria-label="Your email address">
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
