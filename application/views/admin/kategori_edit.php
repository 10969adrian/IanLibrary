<div class="card">
    <form action="<?= base_url('admin/kategori/update') ?>" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="namaKategori" class="form-control"  value="<?= $kategori->namaKategori; ?>">
                     <input type="hidden" name="kategoriID" class="form-control"  value="<?= $kategori->kategoriID; ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?= base_url('admin/kategori') ?>" class="btn btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>