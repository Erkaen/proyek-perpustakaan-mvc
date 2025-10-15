<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $data['judul']; ?></h3>
    <a href="<?= BASEURL; ?>/member" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
<p>Berikut adalah koleksi buku yang tersedia dan siap untuk dipinjam.</p>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Stok Tersedia</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['buku'])): ?>
            <?php foreach ($data['buku'] as $buku): ?>
            <tr>
                <td><?= htmlspecialchars($buku['judul']); ?></td>
                <td><?= htmlspecialchars($buku['penulis']); ?></td>
                <td><?= $buku['tahun_terbit']; ?></td>
                <td><?= $buku['stok']; ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Saat ini tidak ada buku yang tersedia untuk dipinjam.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>