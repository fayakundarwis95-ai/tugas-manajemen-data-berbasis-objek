<?php
class Database {
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $db   = "kopi_ijen";

    public function connect(): mysqli {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        $conn->set_charset('utf8mb4');
        return $conn;
    }
}
?>
