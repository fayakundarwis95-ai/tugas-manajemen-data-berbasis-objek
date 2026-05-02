<?php
require_once dirname(__DIR__) . "/controllers/ProdukController.php";
$controller = new ProdukController();
$data    = $controller->model->getAll();
$total   = $controller->model->count();
$stok    = $controller->model->totalStok();
$pageTitle = 'Katalog Produk — Kopi Ijen';
$msg = $_GET['msg'] ?? '';

require_once "header.php";

// Helper
function formatRupiah(float $n): string {
    return 'Rp ' . number_format($n, 0, ',', '.');
}
?>

<div class="wrapper">
    <div class="page-header">
        <h1>Katalog <em>Kopi Ijen</em></h1>
        <p>Kelola seluruh produk kopi premium dari lereng Gunung Ijen, Banyuwangi.</p>
    </div>

    <?php if ($msg === 'tambah'): ?>
        <div class="alert alert-success">☕ Produk baru berhasil ditambahkan ke katalog.</div>
    <?php elseif ($msg === 'update'): ?>
        <div class="alert alert-success">✓ Data produk berhasil diperbarui.</div>
    <?php elseif ($msg === 'hapus'): ?>
        <div class="alert alert-success">✓ Produk berhasil dihapus dari katalog.</div>
    <?php endif; ?>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Produk</div>
            <div class="stat-value"><?= $total ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Stok (kg)</div>
            <div class="stat-value"><?= number_format($stok, 0, ',', '.') ?></div>
        </div>
    </div>

    <div class="card">
        <div class="toolbar">
            <div class="toolbar-info">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?= $total ?> produk terdaftar
            </div>
            <a href="views/tambah.php" class="btn btn-primary">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Tambah Produk
            </a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Jenis</th>
                        <th>Asal Desa</th>
                        <th>Harga / kg</th>
                        <th>Stok (kg)</th>
                        <th style="text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $rows = [];
                while ($row = $data->fetch_assoc()) $rows[] = $row;
                if (empty($rows)):
                ?>
                    <tr>
                        <td colspan="8">
                            <div class="empty">
                                <div class="empty-icon">☕</div>
                                <p>Belum ada produk.<br>Klik <strong>Tambah Produk</strong> untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                <?php else: foreach ($rows as $row):
                    $stokVal = (int)$row['stok'];
                    $stokClass = $stokVal === 0 ? 'out' : ($stokVal < 10 ? 'low' : 'ok');
                    $stokLabel = $stokVal === 0 ? 'Habis' : number_format($stokVal, 0, ',', '.');
                ?>
                    <tr>
                        <td><span class="badge-no"><?= $no++ ?></span></td>
                        <td><span class="kode-tag"><?= htmlspecialchars($row['kode']) ?></span></td>
                        <td style="font-weight:500;color:var(--cream);"><?= htmlspecialchars($row['nama']) ?></td>
                        <td><span class="jenis-pill"><?= htmlspecialchars($row['jenis']) ?></span></td>
                        <td style="color:var(--muted);font-size:.83rem;"><?= htmlspecialchars($row['asal_desa']) ?></td>
                        <td><span class="harga-text"><?= formatRupiah((float)$row['harga']) ?></span></td>
                        <td>
                            <span class="stok-badge <?= $stokClass ?>">
                                <span class="stok-dot"></span>
                                <?= $stokLabel ?>
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;justify-content:flex-end;gap:.4rem;">
                                <a href="views/edit.php?id=<?= $row['id'] ?>" class="btn btn-ghost btn-sm">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4z"/></svg>
                                    Edit
                                </a>
                                <a href="index.php?hapus=<?= $row['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus produk \"<?= htmlspecialchars($row['nama'], ENT_QUOTES) ?>\"?')">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once "footer.php"; ?>
