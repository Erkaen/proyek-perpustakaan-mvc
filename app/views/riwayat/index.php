<h3><?= $data['judul']; ?></h3>

<div class="card mb-4">
    <div class="card-header">
        Filter & Pencarian
    </div>
    <div class="card-body">
        <form action="<?= BASEURL; ?>/riwayat/index" method="get">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama anggota / judul buku..." value="<?= htmlspecialchars($data['filters']['search'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="borrowed" <?= ($data['filters']['status'] ?? '') == 'borrowed' ? 'selected' : '' ?>>Dipinjam</option>
                        <option value="returned" <?= ($data['filters']['status'] ?? '') == 'returned' ? 'selected' : '' ?>>Dikembalikan</option>
                        <option value="overdue" <?= ($data['filters']['status'] ?? '') == 'overdue' ? 'selected' : '' ?>>Telat</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" value="<?= htmlspecialchars($data['filters']['start_date'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" value="<?= htmlspecialchars($data['filters']['end_date'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="<?= BASEURL; ?>/riwayat" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Peminjam</th>
            <th>Judul Buku</th>
            <th>Tgl Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['history'])): ?>
            <?php foreach ($data['history'] as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_peminjam']); ?></td>
                <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                <td><?= $row['tanggal_pinjam']; ?></td>
                <td><?= $row['tanggal_jatuh_tempo']; ?></td>
                <td><?= $row['tanggal_kembali'] ?? '-'; ?></td>
                <td>
                    <?php 
                        $status = $row['status'];
                        $badgeClass = '';
                        if ($status == 'returned') {
                            $badgeClass = 'bg-success';
                        } elseif ($status == 'overdue') {
                            $badgeClass = 'bg-danger';
                        } else {
                            $badgeClass = 'bg-warning';
                        }
                    ?>
                    <span class="badge <?= $badgeClass; ?>"><?= ucfirst($status); ?></span>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data riwayat yang cocok.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?= $data['currentPage'] <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $data['currentPage'] - 1; ?>&<?= http_build_query($data['filters']) ?>">Previous</a>
        </li>

        <?php for($i = 1; $i <= $data['totalPages']; $i++): ?>
            <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i; ?>&<?= http_build_query($data['filters']) ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>
        
        <li class="page-item <?= $data['currentPage'] >= $data['totalPages'] ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $data['currentPage'] + 1; ?>&<?= http_build_query($data['filters']) ?>">Next</a>
        </li>
    </ul>
</nav>