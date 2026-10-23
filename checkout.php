<?php
$pageTitle = 'Checkout';
require_once __DIR__ . '/includes/header.php';

if (!isLoggedIn()) {
    flash('error', 'Please login before completing checkout.');
    redirect('auth/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout_submit'])) {
    $name = sanitize($_POST['full_name'] ?? '');
    $address = sanitize($_POST['address'] ?? '');
    $method = sanitize($_POST['payment_method'] ?? 'cash_on_delivery');

    if ($name === '' || $address === '') {
        flash('error', 'Please fill in your full name and delivery address.');
        redirect('checkout.php');
    }

    $orderTotal = getCartTotal();
    $_SESSION['last_order_total'] = $orderTotal;
    $_SESSION['last_order_method'] = $method;
    unset($_SESSION['cart']);

    flash('success', 'Your request has been submitted successfully. We will contact you shortly.');
    redirect('checkout.php?success=1');
}

$cartItems = getCartItems();
$total = getCartTotal();
$success = isset($_GET['success']) && $_GET['success'] == '1';
?>
<section class="page-hero inner-page-hero">
    <div class="container small-container">
        <span class="eyebrow">Secure checkout</span>
        <h1>Complete your request</h1>
    </div>
</section>

<section class="section">
    <div class="container checkout-layout">
        <?php if ($success): ?>
            <div class="confirmation-box">
                <i class="fa fa-check-circle"></i>
                <h2>Request confirmed</h2>
                <p>Your service request has been submitted successfully. Our team will contact you soon via phone or email.</p>
                <p><strong>Payment method:</strong> <?= e($_SESSION['last_order_method'] ?? 'Cash on Delivery') ?></p>
                <p><strong>Amount:</strong> KSh <?= number_format((float) ($_SESSION['last_order_total'] ?? 0), 0) ?></p>
                <a href="<?= BASE_URL ?>/index.php" class="btn btn-primary">Back to home</a>
            </div>
        <?php else: ?>
            <form method="post" action="<?= BASE_URL ?>/checkout.php" class="checkout-form">
                <input type="hidden" name="checkout_submit" value="1">
                <div class="checkout-card">
                    <h3>Customer details</h3>
                    <label>
                        Full Name
                        <input type="text" name="full_name" value="<?= e(currentUser()['name']) ?>" required>
                    </label>
                    <label>
                        Address
                        <textarea name="address" rows="4" required></textarea>
                    </label>
                </div>

                <div class="checkout-card">
                    <h3>Payment method</h3>
                    <label class="radio-row"><input type="radio" name="payment_method" value="cash_on_delivery" checked> Cash on Delivery</label>
                    <label class="radio-row"><input type="radio" name="payment_method" value="mpesa"> M-Pesa</label>
                    <label class="radio-row"><input type="radio" name="payment_method" value="bank_transfer"> Bank Transfer</label>
                </div>

                <button type="submit" class="btn btn-primary full-width">Confirm request</button>
            </form>

            <aside class="summary-card">
                <h3>Order summary</h3>
                <?php if (empty($cartItems)): ?>
                    <p>No services selected.</p>
                <?php else: ?>
                    <?php foreach ($cartItems as $item): ?>
                        <div class="summary-row">
                            <span><?= e($item['name']) ?> × <?= (int) $item['quantity'] ?></span>
                            <strong>KSh <?= number_format((float) $item['price'] * (int) $item['quantity'], 0) ?></strong>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="summary-row total-row">
                    <span>Total</span>
                    <strong>KSh <?= number_format($total, 0) ?></strong>
                </div>
            </aside>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
