-- ============================================================
-- Kopi Ijen — Database Setup
-- ============================================================

CREATE DATABASE IF NOT EXISTS kopi_ijen
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE kopi_ijen;

CREATE TABLE IF NOT EXISTS produk (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    kode       VARCHAR(20)   NOT NULL UNIQUE,
    nama       VARCHAR(150)  NOT NULL,
    jenis      VARCHAR(50)   NOT NULL,
    asal_desa  VARCHAR(150)  NOT NULL,
    harga      DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok       INT           NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data contoh produk kopi Ijen
INSERT INTO produk (kode, nama, jenis, asal_desa, harga, stok) VALUES
('KI-001', 'Arabika Ijen Sundried Natural',   'Arabika', 'Desa Kalianyar, Banyuwangi',  95000, 80),
('KI-002', 'Arabika Ijen Honey Process',       'Arabika', 'Desa Tamansari, Banyuwangi', 110000, 45),
('KI-003', 'Robusta Ijen Fullwash',            'Robusta', 'Desa Gombengsari, Banyuwangi', 65000, 120),
('KI-004', 'Arabika Ijen Wine Process',        'Arabika', 'Desa Kampunganyar, Banyuwangi',130000, 20),
('KI-005', 'Blend Ijen Signature Espresso',    'Blend',   'Koperasi Petani Ijen, Banyuwangi', 80000, 60);
