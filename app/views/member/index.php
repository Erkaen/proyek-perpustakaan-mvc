<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Selamat Datang, <?= $_SESSION['user_nama']; ?>!</h3>
    <a href="<?= BASEURL; ?>/member/daftarBuku" class="btn btn-primary">Lihat Semua Buku Tersedia</a>
</div>

<p>Ini adalah daftar buku yang sedang Anda pinjam.</p>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['peminjaman'])): ?>
            <?php foreach ($data['peminjaman'] as $buku): ?>
            <tr>
                <td><?= htmlspecialchars($buku['judul_buku']); ?></td>
                <td><?= $buku['tanggal_pinjam']; ?></td>
                <td><?= $buku['tanggal_jatuh_tempo']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">Anda tidak memiliki peminjaman aktif saat ini.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>