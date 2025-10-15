<h3><?= $data['judul']; ?></h3>

<div class="card">
    <div class="card-body">
        <form action="<?= BASEURL; ?>/transaksi/prosesPinjam" method="post">
            <div class="mb-3">
                <label for="user_id" class="form-label">Pilih Anggota</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="" disabled selected>-- Pilih Peminjam --</option>
                    <?php foreach ($data['anggota'] as $anggota): ?>
                        <option value="<?= $anggota['id']; ?>"><?= $anggota['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="book_id" class="form-label">Pilih Buku</label>
                <select class="form-select" id="book_id" name="book_id" required>
                    <option value="" disabled selected>-- Pilih Judul Buku --</option>
                    <?php foreach ($data['buku'] as $buku): ?>
                        <?php if ($buku['stok'] > 0): ?>
                            <option value="<?= $buku['id']; ?>">
                                <?= $buku['judul']; ?> (Stok: <?= $buku['stok']; ?>)
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Proses Peminjaman</button>
        </form>
    </div>
</div>