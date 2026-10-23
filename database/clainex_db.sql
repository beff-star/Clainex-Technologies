CREATE DATABASE IF NOT EXISTS clainex_db;
USE clainex_db;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    username VARCHAR(80) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(30) DEFAULT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    designation VARCHAR(120) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_admin_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(180) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) DEFAULT NULL,
    status ENUM('active', 'draft', 'archived') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_service_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    service_name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'in_review', 'quoted', 'approved', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_request_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_request_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS service_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    service_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    CONSTRAINT fk_service_item_request FOREIGN KEY (request_id) REFERENCES requests(id) ON DELETE CASCADE,
    CONSTRAINT fk_service_item_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    payment_method ENUM('cash_on_delivery', 'mpesa', 'bank_transfer') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    reference_code VARCHAR(120) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_request FOREIGN KEY (request_id) REFERENCES requests(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    subject VARCHAR(150) DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_review_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO categories (name, slug, description) VALUES
('Software solutions', 'software-solutions', 'Custom software systems, portals, and digital tools.'),
('IT infrastructure', 'it-infrastructure', 'Infrastructure design and operations support.'),
('Cyber security', 'cyber-security', 'Risk prevention, monitoring, and security services.'),
('AI', 'ai', 'AI automation and smart business transformation.'),
('Data science and analytics', 'data-science-and-analytics', 'Dashboards, insights, and predictive models.'),
('Cloud and digital solutions', 'cloud-and-digital-solutions', 'Cloud migration and digital modernization.');

INSERT INTO users (full_name, username, email, phone, password_hash, role) VALUES
('Clainex Admin', 'admin', 'admin@clainextech.com', '+254700000000', '$2y$10$8V1iDq2M7D4xk2Qh0R33b.p6I4cY7zKwq6gXV6f.cwM26Y7J6E/DS', 'admin');

INSERT INTO admins (user_id, designation) VALUES (1, 'System Administrator');

INSERT INTO services (category_id, name, slug, description, price, image_url) VALUES
(1, 'Custom Software Development', 'custom-software-development', 'Custom business software, portals, and internal tools built to simplify operations and grow revenue.', 1200.00, 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80'),
(2, 'IT Infrastructure Management', 'it-infrastructure-management', 'Reliable infrastructure optimization covering networking, servers, hardware, and support workflows.', 950.00, 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80'),
(3, 'Cyber Security Assessment', 'cyber-security-assessment', 'Protect your business with monitoring, audits, compliance checks, and preventive cybersecurity strategy.', 1400.00, 'https://images.unsplash.com/photo-1563986768494-4d9f7d9b6b9d?auto=format&fit=crop&w=900&q=80'),
(4, 'AI & Automation Solutions', 'ai-automation-solutions', 'Smart workflows, AI automation, and data-driven business intelligence for more efficient decision making.', 1750.00, 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=900&q=80'),
(5, 'Data Science & Analytics', 'data-science-analytics', 'Interactive dashboards, predictive modeling, and analytical insights for measurable growth outcomes.', 1300.00, 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80'),
(6, 'Cloud & Digital Transformation', 'cloud-digital-transformation', 'End-to-end digital transformation strategy with cloud migration, optimization, and platform modernization.', 1600.00, 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80');
