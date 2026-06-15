<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        Tambah Buku
    </button>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?= base_url('admin/buku/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis buku" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategoriID" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach($kategori as $k){ ?>
                                        <option value="<?= $k['kategoriID']; ?>">
                                            <?= $k['namaKategori']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" placeholder="Masukkan penerbit buku" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tahun Terbit</label>
                                <input type="number" name="tahunTerbit" class="form-control" placeholder="Masukkan tahun terbit buku" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Cover</label>
                                <input type="file" name="cover" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="card mb-3 p-3">

    <form method="get" action="<?= base_url('admin/buku') ?>">

        <div class="row g-2 align-items-end">

            <div class="col-md">
                <input type="text" name="judul" class="form-control" placeholder="Judul"
                       value="<?= $this->input->get('judul'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="penulis" class="form-control" placeholder="Penulis"
                       value="<?= $this->input->get('penulis'); ?>">
            </div>

            <div class="col-md">
                <select name="kategori" class="form-control">
                    <option value="">Kategori</option>
                    <?php foreach($kategori as $k){ ?>
                        <option value="<?= $k['namaKategori']; ?>"
                            <?= ($this->input->get('kategori') == $k['namaKategori']) ? 'selected' : '' ?>>
                            <?= $k['namaKategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md">
                <input type="text" name="penerbit" class="form-control" placeholder="Penerbit"
                       value="<?= $this->input->get('penerbit'); ?>">
            </div>

            

            <div class="col-md">
                <input type="number" name="tahun" class="form-control" placeholder="Tahun"
                       value="<?= $this->input->get('tahun'); ?>">
            </div>

            <div class="col-md">
    <select name="status" class="form-control">
        <option value="">Status</option>
        <option value="Tersedia" <?= ($this->input->get('status') == 'Tersedia') ? 'selected' : '' ?>>
            Tersedia
        </option>
        <option value="Dipinjam" <?= ($this->input->get('status') == 'Dipinjam') ? 'selected' : '' ?>>
            Dipinjam
        </option>
    </select>
</div>

            <div class="col-md-auto">
                <a href="<?= base_url('admin/buku') ?>" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
            <div class="col-md-auto">
                <button class="btn btn-primary w-100">Cari</button>
            </div>
        </div>

    </form>

</div>

<div class="card">
    <h5 class="card-header">Data Buku</h5>

    <div class="table-responsive text-nowrap">
        <table class="table table-sm table-fixed table-hover align-middle w-100">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no=1; foreach($buku as $row){ ?>
                <tr>
                    <th><?= $no; ?></th>

                    <td>
                        <?php if($row['cover']){ ?>
                            <img src="<?= base_url('sneat')?>/assets/upload/cover/<?= $row['cover'] ?>" width="100">
                        <?php }else{ ?>
                            -
                        <?php } ?>
                    </td>

                    <td><?= $row['judul']; ?></td>
                    <td><?= $row['penulis']; ?></td>
                    <td><?= $row['namaKategori']; ?></td>
                    <td><?= $row['penerbit']; ?></td>
                    <td><?= $row['tahunTerbit']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <a onclick="return confirm('Hapus Data Ini?');"
                           href="<?= base_url('admin/buku/hapus/'.$row['bukuID']) ?>"
                           class="btn-sm btn-danger">Hapus</a>

                        <a href="<?= base_url('admin/buku/edit/'.$row['bukuID']) ?>"
                           class="btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
                <?php $no++; } ?>
            </tbody>

        </table>
    </div>
</div>

