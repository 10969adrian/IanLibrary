<div class="card p-4">
    <form action="<?= base_url('admin/buku/update') ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <!-- KIRI: FORM -->
            <div class="col-md-8">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $buku->judul; ?>">
                    <input type="hidden" name="bukuID" value="<?= $buku->bukuID; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= $buku->penulis; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategoriID" class="form-control">
                        <?php foreach($kategori as $k){ ?>
                            <option value="<?= $k['kategoriID']; ?>" 
                                <?= ($k['kategoriID'] == $buku->kategoriID) ? 'selected' : ''; ?>>
                                <?= $k['namaKategori']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" value="<?= $buku->penerbit; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahunTerbit" class="form-control" value="<?= $buku->tahunTerbit; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Cover Baru</label>
                    <input type="file" name="cover" class="form-control">
                    <input type="hidden" name="cover_lama" value="<?= $buku->cover; ?>">
                </div>

                <div class="mt-3">
                    <a href="<?= base_url('admin/buku') ?>" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </div>

            <!-- KANAN: PREVIEW COVER -->
            <div class="col-md-4 text-center">
                <label class="form-label d-block">Cover</label>

                <?php if($buku->cover){ ?>
                    <img src="<?= base_url('sneat')?>/assets/upload/cover/<?= $buku->cover ?>" 
                         class="img-fluid rounded shadow-sm mt-2"
                         style="max-height: 450px; object-fit: cover;">
                <?php } else { ?>
                    <p class="text-muted">Tidak ada cover</p>
                <?php } ?>
            </div>

        </div>

    </form>
</div>