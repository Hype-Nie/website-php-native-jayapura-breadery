CREATE DATABASE IF NOT EXISTS db_kasir_barcode;
USE db_kasir_barcode;

-- Users & Authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(150) DEFAULT '',
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','karyawan') NOT NULL DEFAULT 'karyawan',
    phone VARCHAR(20) DEFAULT '',
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Categories
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description VARCHAR(255) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Suppliers
CREATE TABLE IF NOT EXISTS suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    email VARCHAR(150) DEFAULT '',
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barcode VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    category_id INT DEFAULT NULL,
    category VARCHAR(100) DEFAULT '',
    price DECIMAL(12,0) NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_barcode (barcode),
    INDEX idx_category_id (category_id),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sales Transactions
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_code VARCHAR(50) UNIQUE NOT NULL,
    total_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    payment_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    change_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    user_id INT DEFAULT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_code (transaction_code),
    INDEX idx_date (transaction_date),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS transaction_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    barcode VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(12,0) NOT NULL DEFAULT 0,
    subtotal DECIMAL(12,0) NOT NULL DEFAULT 0,
    FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Purchase Transactions
CREATE TABLE IF NOT EXISTS purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_code VARCHAR(50) UNIQUE NOT NULL,
    supplier_id INT DEFAULT NULL,
    total_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    notes TEXT,
    user_id INT DEFAULT NULL,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_purchase_code (purchase_code),
    INDEX idx_purchase_date (purchase_date),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS purchase_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    barcode VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(12,0) NOT NULL DEFAULT 0,
    subtotal DECIMAL(12,0) NOT NULL DEFAULT 0,
    FOREIGN KEY (purchase_id) REFERENCES purchases(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Customers
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(20) DEFAULT '',
    email VARCHAR(150) DEFAULT '',
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Customer Orders
CREATE TABLE IF NOT EXISTS customer_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(50) UNIQUE NOT NULL,
    customer_id INT DEFAULT NULL,
    customer_name VARCHAR(150) DEFAULT '',
    customer_phone VARCHAR(20) DEFAULT '',
    total_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    payment_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    change_amount DECIMAL(12,0) NOT NULL DEFAULT 0,
    status ENUM('pending','paid','cancelled') NOT NULL DEFAULT 'pending',
    notes TEXT,
    user_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_order_code (order_code),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at),
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS customer_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    barcode VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(12,0) NOT NULL DEFAULT 0,
    subtotal DECIMAL(12,0) NOT NULL DEFAULT 0,
    FOREIGN KEY (order_id) REFERENCES customer_orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default users (password: password)
INSERT IGNORE INTO users (name, username, email, password, role) VALUES
('Administrator', 'admin', 'admin@kasir.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Karyawan Demo', 'employee', 'employee@kasir.local', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'karyawan');

-- Default categories
INSERT IGNORE INTO categories (name, description) VALUES
('Aksesoris', 'Kalung, gelang, cincin, dan perhiasan'),
('Tatoo', 'Tato temporer dan stiker body art'),
('Piercing', 'Piercing badan dan accessories'),
('Merchandise', 'Kaos, tote bag, dan merchandise lainnya');

-- Default suppliers
INSERT IGNORE INTO suppliers (name, phone, email, address) VALUES
('Tatto Art Supply', '021-1234567', 'order@tattoart.id', 'Jakarta Selatan'),
('Piercing Express', '021-7654321', 'sales@piercingexpress.id', 'Bekasi, Jawa Barat'),
('Merch Factory', '021-9988776', 'supply@merchfactory.id', 'Jakarta Selatan');

-- Run this if products table already exists without image column:
-- ALTER TABLE products ADD COLUMN image VARCHAR(255) DEFAULT '' AFTER stock;

-- Sample products
INSERT IGNORE INTO products (barcode, name, category_id, category, price, stock) VALUES
('ATK001', 'Kalung Rantai Silver', 1, 'Aksesoris', 85000, 30),
('ATK002', 'Gelang Charm Gold', 1, 'Aksesoris', 65000, 45),
('ATK003', 'Cincin Vintage Bronze', 1, 'Aksesoris', 45000, 60),
('ATK004', 'Anting Feather', 1, 'Aksesoris', 35000, 50),
('ATK005', 'Bangle Kawat Tembaga', 1, 'Aksesoris', 55000, 40),
('TTO001', 'Tato Butterfly (L)', 2, 'Tatoo', 25000, 100),
('TTO002', 'Tato Rose (M)', 2, 'Tatoo', 20000, 120),
('TTO003', 'Tato Dragon (XL)', 2, 'Tatoo', 35000, 80),
('TTO004', 'Tato Tribal Set', 2, 'Tatoo', 30000, 90),
('TTO005', 'Tato Flower Mandala', 2, 'Tatoo', 28000, 110),
('PRC001', 'Nose Ring Hoop', 3, 'Piercing', 30000, 75),
('PRC002', 'Ear Cuff Spiral', 3, 'Piercing', 40000, 60),
('PRC003', 'Lip Ring Ball', 3, 'Piercing', 20000, 85),
('MRC001', 'Kaos Logo The Beadery (M)', 4, 'Merchandise', 120000, 25),
('MRC002', 'Tote Bag Canvas', 4, 'Merchandise', 85000, 35),
('MRC003', 'Sticker Pack Beadery', 4, 'Merchandise', 15000, 200);
