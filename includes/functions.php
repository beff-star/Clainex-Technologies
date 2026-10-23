<?php
require_once __DIR__ . '/../config.php';

function serviceCatalog(): array
{
    return [
        [
            'id' => 1,
            'name' => 'Custom Software Development',
            'category' => 'Software solutions',
            'price' => 1200,
            'description' => 'Custom business software, portals, and internal tools built to simplify operations and grow revenue.',
            'badge' => 'Popular',
            'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 2,
            'name' => 'IT Infrastructure Management',
            'category' => 'IT infrastructure',
            'price' => 950,
            'description' => 'Reliable infrastructure optimization covering networking, servers, hardware, and support workflows.',
            'badge' => 'Core',
            'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 3,
            'name' => 'Cyber Security Assessment',
            'category' => 'Cyber security',
            'price' => 1400,
            'description' => 'Protect your business with monitoring, audits, compliance checks, and preventive cybersecurity strategy.',
            'badge' => 'Secure',
            'image' => 'https://images.unsplash.com/photo-1563986768494-4d9f7d9b6b9d?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 4,
            'name' => 'AI & Automation Solutions',
            'category' => 'AI',
            'price' => 1750,
            'description' => 'Smart workflows, AI automation, and data-driven business intelligence for more efficient decision making.',
            'badge' => 'AI',
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 5,
            'name' => 'Data Science & Analytics',
            'category' => 'Data science and analytics',
            'price' => 1300,
            'description' => 'Interactive dashboards, predictive modeling, and analytical insights for measurable growth outcomes.',
            'badge' => 'Insights',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80'
        ],
        [
            'id' => 6,
            'name' => 'Cloud & Digital Transformation',
            'category' => 'Cloud and digital solutions',
            'price' => 1600,
            'description' => 'End-to-end digital transformation strategy with cloud migration, optimization, and platform modernization.',
            'badge' => 'Cloud',
            'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80'
        ],
    ];
}

function getServiceById(int $id): ?array
{
    foreach (serviceCatalog() as $service) {
        if ((int) $service['id'] === $id) {
            return $service;
        }
    }

    return null;
}

function addToCart(int $serviceId): void
{
    $services = serviceCatalog();
    $service = getServiceById($serviceId);

    if (!$service) {
        flash('error', 'The selected service could not be found.');
        return;
    }

    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $key = (string) $serviceId;
    if (!isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key] = [
            'id' => $service['id'],
            'name' => $service['name'],
            'category' => $service['category'],
            'price' => $service['price'],
            'quantity' => 1,
        ];
    } else {
        $_SESSION['cart'][$key]['quantity'] += 1;
    }

    flash('success', $service['name'] . ' was added to your service request cart.');
}

function removeFromCart(int $serviceId): void
{
    if (!empty($_SESSION['cart'])) {
        unset($_SESSION['cart'][(string) $serviceId]);
    }

    flash('success', 'Service removed from your request list.');
}

function getCartItems(): array
{
    return $_SESSION['cart'] ?? [];
}

function getCartTotal(): float
{
    $total = 0;
    foreach (getCartItems() as $item) {
        $total += (float) $item['price'] * (int) $item['quantity'];
    }
    return $total;
}

function getRequestStatusOptions(): array
{
    return [
        'pending',
        'in_review',
        'quoted',
        'approved',
        'completed',
        'cancelled',
    ];
}
