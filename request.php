<?php
$pageTitle = 'Request Service';
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $serviceId = (int) ($_POST['service_id'] ?? 0);
    if ($serviceId > 0) {
        addToCart($serviceId);
    }
    redirect('request.php');
}

$services = serviceCatalog();
$search = sanitize($_GET['q'] ?? '');
$category = sanitize($_GET['category'] ?? '');
$sort = sanitize($_GET['sort'] ?? 'name');
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 4;

$filtered = [];
foreach ($services as $service) {
    $matchesSearch = $search === '' || stripos($service['name'], $search) !== false || stripos($service['description'], $search) !== false;
    $matchesCategory = $category === '' || $service['category'] === $category;

    if ($matchesSearch && $matchesCategory) {
        $filtered[] = $service;
    }
}

$sortOptions = [
    'name' => fn($a, $b) => strcmp($a['name'], $b['name']),
    'price_asc' => fn($a, $b) => (float) $a['price'] <=> (float) $b['price'],
    'price_desc' => fn($a, $b) => (float) $b['price'] <=> (float) $a['price'],
];

if (isset($sortOptions[$sort])) {
    usort($filtered, $sortOptions[$sort]);
}

$totalPages = max(1, (int) ceil(count($filtered) / $perPage));
$page = min($page, $totalPages);
$start = ($page - 1) * $perPage;
$paginated = array_slice($filtered, $start, $perPage);
$categories = array_unique(array_map(fn($item) => $item['category'], $services));
?>
<section class="page-hero inner-page-hero">
    <div class="container small-container">
        <span class="eyebrow">Request a solution</span>
        <h1>Find the right service for your business</h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <form class="service-filter" method="get" action="<?= BASE_URL ?>/request.php">
            <div class="filter-group">
                <label for="search">Search</label>
                <input type="search" id="search" name="q" value="<?= e($search) ?>" placeholder="Search services...">
            </div>
            <div class="filter-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All categories</option>
                    <?php foreach ($categories as $option): ?>
                        <option value="<?= e($option) ?>" <?= $category === $option ? 'selected' : '' ?>><?= e($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-group">
                <label for="sort">Sort by</label>
                <select id="sort" name="sort">
                    <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name</option>
                    <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                    <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apply filters</button>
        </form>

        <div class="service-grid card-grid">
            <?php if (empty($paginated)): ?>
                <div class="empty-state">
                    <h3>No services match your filters.</h3>
                    <p>Try another category or search term.</p>
                </div>
            <?php else: ?>
                <?php foreach ($paginated as $service): ?>
                    <article class="service-card request-card">
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
                                <form method="post" action="<?= BASE_URL ?>/request.php" class="inline-form">
                                    <input type="hidden" name="service_id" value="<?= (int) $service['id'] ?>">
                                    <input type="hidden" name="add_to_cart" value="1">
                                    <button type="submit" class="btn btn-primary small-btn">Add to request</button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (count($filtered) > $perPage): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="<?= BASE_URL ?>/request.php?q=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>&sort=<?= urlencode($sort) ?>&page=<?= $i ?>" class="page-link <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
