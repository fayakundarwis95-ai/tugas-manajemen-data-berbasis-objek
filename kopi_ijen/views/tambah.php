<?php
require_once dirname(__DIR__) . "/controllers/ProdukController.php";
$controller = new ProdukController();

$errors  = [];
$kode    = $nama = $jenis = $asal_desa = '';
$harga   = '';
$stok    = '';

$jenis_options = ['Arabika', 'Robusta', 'Liberika', 'Excelsa', 'Blend'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $kode      = trim($_POST['kode']      ?? '');
    $nama      = trim($_POST['nama']      ?? '');
    $jenis     = trim($_POST['jenis']     ?? '');
    $asal_desa = trim($_POST['asal_desa'] ?? '');
    $harga     = trim($_POST['harga']     ?? '');
    $stok      = trim($_POST['stok']      ?? '');

    if ($kode      === '') $errors[] = 'Kode produk wajib diisi.';
    if ($nama      === '') $errors[] = 'Nama produk wajib diisi.';
    if ($jenis     === '') $errors[] = 'Jenis kopi wajib dipilih.';
    if ($asal_desa === '') $errors[] = 'Asal desa wajib diisi.';
    if ($harga     === '' || !is_numeric($harga) || (float)$harga <= 0) $errors[] = 'Harga harus berupa angka positif.';
    if ($stok      === '' || !is_numeric($stok)  || (int)$stok   <  0) $errors[] = 'Stok harus berupa angka ≥ 0.';

    if (empty($errors)) {
        $controller->model->create($kode, $nama, $jenis, $asal_desa, (float)$harga, (int)$stok);
        header("Location: ../index.php?msg=tambah");
        exit;
    }
}

$pageTitle = 'Tambah Produk — Kopi Ijen';
require_once "header.php";
?>

<div class="wrapper" style="max-width:640px;">
    <div class="page-header">
        <a href="../index.php" class="btn btn-ghost btn-sm" style="margin-bottom:1.2rem;">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
        <h1>Tambah <em>Produk</em></h1>
        <p>Daftarkan produk kopi baru ke dalam katalog Kopi Ijen.</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <?= implode(' &nbsp;·&nbsp; ', array_map('htmlspecialchars', $errors)) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="form-wrap">
            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="kode">Kode Produk</label>
                        <input type="text" id="kode" name="kode"
                               value="<?= htmlspecialchars($kode) ?>"
                               placeholder="Contoh: KI-001">
                        <div class="field-hint">Identifikasi unik untuk produk ini.</div>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Kopi</label>
                        <div class="select-wrap">
                            <select id="jenis" name="jenis">
                                <option value="">— Pilih Jenis —</option>
                                <?php foreach ($jenis_options as $j): ?>
                                    <option value="<?= $j ?>" <?= $jenis === $j ? 'selected' : '' ?>><?= $j ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group full">
                        <label for="nama">Nama Produk</label>
                        <input type="text" id="nama" name="nama"
                               value="<?= htmlspecialchars($nama) ?>"
                               placeholder="Contoh: Kopi Arabika Ijen Premium">
                    </div>

                    <div class="form-group full">
                        <label for="asal_desa">Asal Desa / Perkebunan</label>
                        <input type="text" id="asal_desa" name="asal_desa"
                               value="<?= htmlspecialchars($asal_desa) ?>"
                               placeholder="Contoh: Desa Kalianyar, Banyuwangi">
                    </div>

                    <hr class="form-divider">

                    <div class="form-group">
                        <label for="harga">Harga per kg (Rp)</label>
                        <input type="number" id="harga" name="harga"
                               value="<?= htmlspecialchars($harga) ?>"
                               placeholder="Contoh: 85000" min="0" step="500">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok (kg)</label>
                        <input type="number" id="stok" name="stok"
                               value="<?= htmlspecialchars($stok) ?>"
                               placeholder="Contoh: 50" min="0">
                    </div>
                </div>

                <div class="form-actions" style="margin-top:1.8rem;">
                    <button type="submit" name="simpan" class="btn btn-primary" style="flex:1;justify-content:center;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Produk
                    </button>
                    <a href="../index.php" class="btn btn-ghost" style="justify-content:center;min-width:90px;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>
