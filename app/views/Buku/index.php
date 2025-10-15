<h3><?= $data['judul']; ?></h3>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
  Tambah Data Buku
</button>

<table class="table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['buku'] as $buku) : ?>
        <tr>
            <td><?= $buku['judul']; ?></td>
            <td><?= $buku['penulis']; ?></td>
            <td><?= $buku['tahun_terbit']; ?></td>
            <td><?= $buku['stok']; ?></td>
            <td>
                <a href="<?= BASEURL; ?>/buku/hapus/<?= $buku['id']; ?>" class="badge bg-danger" onclick="return confirm('yakin?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button ...><i class="bi bi-plus-circle"></i> Tambah Data Buku</button>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/buku/tambah" method="post">
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
          </div>
          <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required>
          </div>
          <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
          </div>
          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
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