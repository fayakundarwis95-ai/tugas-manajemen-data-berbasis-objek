<?php
class Produk {
    private mysqli $conn;

    public function __construct(mysqli $db) {
        $this->conn = $db;
    }

    public function getAll(): mysqli_result|bool {
        return $this->conn->query("SELECT * FROM produk ORDER BY id DESC");
    }

    public function getById(int $id): array|null {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create(string $kode, string $nama, string $jenis, string $asal_desa, float $harga, int $stok): bool {
        $stmt = $this->conn->prepare(
            "INSERT INTO produk (kode, nama, jenis, asal_desa, harga, stok) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssd i", $kode, $nama, $jenis, $asal_desa, $harga, $stok);
        return $stmt->execute();
    }

    public function update(int $id, string $kode, string $nama, string $jenis, string $asal_desa, float $harga, int $stok): bool {
        $stmt = $this->conn->prepare(
            "UPDATE produk SET kode=?, nama=?, jenis=?, asal_desa=?, harga=?, stok=? WHERE id=?"
        );
        $stmt->bind_param("ssssdii", $kode, $nama, $jenis, $asal_desa, $harga, $stok, $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function count(): int {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM produk");
        return (int)$result->fetch_assoc()['total'];
    }

    public function totalStok(): int {
        $result = $this->conn->query("SELECT SUM(stok) as total FROM produk");
        return (int)($result->fetch_assoc()['total'] ?? 0);
    }
}
?>
