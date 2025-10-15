<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3>Dashboard</h3>
        <p class="text-muted">Selamat Datang kembali, <?= htmlspecialchars($_SESSION['user_nama'] ?? 'Admin'); ?>!</p>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark text-white mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Total Judul Buku</h5>
                    <p class="card-text fs-2"><?= $data['total_buku']; ?></p>
                </div>
                <i class="bi bi-book-half fs-1 text-secondary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark text-white mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Jumlah Anggota</h5>
                    <p class="card-text fs-2"><?= $data['total_anggota']; ?></p>
                </div>
                <i class="bi bi-people-fill fs-1 text-secondary"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark text-white mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Peminjaman Aktif</h5>
                    <p class="card-text fs-2"><?= $data['peminjaman_aktif']; ?></p>
                </div>
                <i class="bi bi-arrow-down-up fs-1 text-secondary"></i>
            </div>
        </div>
    </div>
</div>