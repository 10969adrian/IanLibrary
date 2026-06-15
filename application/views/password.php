<?= $this->session->flashdata('notifikasi', TRUE); ?>
<div class="card">
    <form action="<?= base_url('auth/updatePassword') ?>" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="text" name="passwordBaru" class="form-control" placeholder="Masukkan password baru" required>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="text" name="passwordKonf" class="form-control" placeholder="Ulangi password baru" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?= base_url('home') ?>" class="btn btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>