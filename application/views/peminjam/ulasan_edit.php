<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="mb-3">
    <h4>Edit Review</h4>
</div>

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card shadow-sm p-3">

            <div class="row">

                <!-- FORM -->
                <div class="col-md-8">

                    <form action="<?= base_url('peminjam/ulasan/update') ?>" method="post">

                        <!-- ⚠️ INI WAJIB DI DALAM FORM -->
                        <input type="hidden" name="ulasanID" value="<?= $ulasan->ulasanID ?>">

                        <h6 class="mb-3"><?= $ulasan->judul; ?></h6>

                        <div class="mb-3">
                            <label>Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="5" <?= ($ulasan->rating == 5) ? 'selected' : '' ?>>★★★★★</option>
                                <option value="4" <?= ($ulasan->rating == 4) ? 'selected' : '' ?>>★★★★</option>
                                <option value="3" <?= ($ulasan->rating == 3) ? 'selected' : '' ?>>★★★</option>
                                <option value="2" <?= ($ulasan->rating == 2) ? 'selected' : '' ?>>★★</option>
                                <option value="1" <?= ($ulasan->rating == 1) ? 'selected' : '' ?>>★</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Ulasan</label>
                            <textarea name="ulasan" class="form-control" rows="5"><?= $ulasan->ulasan; ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('peminjam/ulasan') ?>" class="btn btn-outline-secondary">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>

                <!-- COVER -->
                <div class="col-md-4">
                    <img src="<?= base_url('sneat/assets/upload/cover/'.$ulasan->cover) ?>"
                         style="width:100%; aspect-ratio:3/4; object-fit:cover; border-radius:8px;">
                </div>

            </div>

        </div>

    </div>

</div>  