<?php
$pageTitle = 'Cart';
require_once __DIR__ . '/includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_service'])) {
    $serviceId = (int) ($_POST['service_id'] ?? 0);
    if ($serviceId > 0) {
        removeFromCart($serviceId);
    }
    redirect('cart.php');
}

$cartItems = getCartItems();
$total = getCartTotal();
?>
<section class="page-hero inner-page-hero">
    <div class="container small-container">
        <span class="eyebrow">Request summary</span>
        <h1>Your service request cart</h1>
    </div>
</section>

<section class="section">
    <div class="container cart-layout">
        <div class="cart-items">
            <?php if (empty($cartItems)): ?>
                <div class="empty-state">
                    <h3>Your request cart is empty.</h3>
                    <p>Add services from our request page to begin a quote.</p>
                    <a href="<?= BASE_URL ?>/request.php" class="btn btn-primary">Browse services</a>
                </div>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div>
                            <h3><?= e($item['name']) ?></h3>
                            <p><?= e($item['category']) ?></p>
                        </div>
                        <div class="cart-item-meta">
                            <span>Qty: <?= (int) $item['quantity'] ?></span>
                            <strong>KSh <?= number_format((float) $item['price'] * (int) $item['quantity'], 0) ?></strong>
                        </div>
                        <form method="post" action="<?= BASE_URL ?>/cart.php" class="inline-form">
                            <input type="hidden" name="service_id" value="<?= (int) $item['id'] ?>">
                            <input type="hidden" name="remove_service" value="1">
                            <button type="submit" class="btn btn-secondary small-btn">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <aside class="summary-card">
            <h3>Request summary</h3>
            <div class="summary-row">
                <span>Subtotal</span>
                <strong>KSh <?= number_format($total, 0) ?></strong>
            </div>
            <div class="summary-row">
                <span>Consultation</span>
                <strong>KSh 0</strong>
            </div>
            <div class="summary-row total-row">
                <span>Total</span>
                <strong>KSh <?= number_format($total, 0) ?></strong>
            </div>
            <a href="<?= BASE_URL ?>/checkout.php" class="btn btn-primary full-width">Proceed to checkout</a>
        </aside>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
