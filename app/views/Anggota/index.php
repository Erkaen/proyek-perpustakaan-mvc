<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $data['judul']; ?></h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
      Tambah Data Anggota
    </button>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%;">#</th>
            <th>Nama</th>
            <th>Email</th>
            <th style="width: 15%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        if (!empty($data['anggota'])) {
            foreach ($data['anggota'] as $anggota) : 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $anggota['nama']; ?></td>
            <td><?= $anggota['email']; ?></td>
            <td>
                <a href="<?= BASEURL; ?>/anggota/hapus/<?= $anggota['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('yakin?');">Hapus</a>
            </td>
        </tr>
        <?php 
            endforeach; 
        } else {
            echo '<tr><td colspan="4" class="text-center">Tidak ada data anggota.</td></tr>';
        }
        ?>
    </tbody>
</table>

<div class="modal fade" id="formModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button ...><i class="bi bi-plus-circle"></i> Tambah Data Anggota</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/anggota/tambah" method="post">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>