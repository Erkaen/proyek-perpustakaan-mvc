<h3><?= $data['judul']; ?></h3>

<a href="<?= BASEURL; ?>/transaksi/pinjam" class="btn btn-primary mb-3">
  Catat Peminjaman Baru
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['transaksi'])): ?>
            <?php foreach ($data['transaksi'] as $trx): ?>
            <tr>
                <td><?= $trx['nama_peminjam']; ?></td>
                <td><?= $trx['judul_buku']; ?></td>
                <td><?= $trx['tanggal_pinjam']; ?></td>
                <td><?= $trx['tanggal_jatuh_tempo']; ?></td>
                <td>
                    <span class="badge bg-warning"><?= $trx['status']; ?></span>
                </td>
                <td>
                    <a href="<?= BASEURL; ?>/transaksi/kembalikan/<?= $trx['id']; ?>" class="btn btn-success btn-sm">Kembalikan</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data peminjaman aktif.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>