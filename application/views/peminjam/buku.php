<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="card mb-3 p-3">

    <form method="get" action="<?= base_url('peminjam/buku') ?>">

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
                    <?php foreach ($kategori as $k) { ?>
                        <option value="<?= $k['namaKategori']; ?>" <?= ($this->input->get('kategori') == $k['namaKategori']) ? 'selected' : '' ?>>
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
                <a href="<?= base_url('peminjam/buku') ?>" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>

            <div class="col-md-auto">
                <button class="btn btn-primary w-100">Cari</button>
            </div>

        </div>

    </form>

</div>
<style>
    .book-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: .2s;
    }

    .book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(67, 89, 113, .12);
    }

    .book-cover {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        background: #f5f5f9;
    }

    .book-title {
        font-size: 14px;
        font-weight: 700;
        line-height: 1.4;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;

        min-height: 40px;
    }

    .book-author {
        font-size: 12px;
        color: #697a8d;
    }

    .book-rating {
        color: #f5c518;
        font-size: 13px;
    }

    .review-user-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .review-box {
        border: 1px solid #ebeef2;
        border-radius: 12px;
        padding: 12px;
    }
</style>
<div class="row g-3">

    <?php foreach ($buku as $row) { ?>

        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

            <div class="card book-card h-100">

                <div data-bs-toggle="modal" data-bs-target="#detail<?= $row['bukuID']; ?>" style="cursor:pointer;">

                    <?php if ($row['cover']) { ?>

                        <img src="<?= base_url('sneat/assets/upload/cover/' . $row['cover']) ?>" class="book-cover">

                    <?php } ?>

                </div>

                <div class="card-body">

                    <div class="book-title">

                        <?= $row['judul']; ?>

                    </div>

                    <div class="book-author mb-2">

                        <?= $row['penulis']; ?>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">

                        <span class="book-rating">

                            ★ <?= $row['ratingRata']; ?>

                        </span>

                        <span class="text-muted small">

                            <?= $row['totalReview']; ?> Review

                        </span>

                    </div>

                    <div class="d-flex gap-1 mt-2">

                        <a href="<?= site_url('peminjam/koleksi/tambah/' . $row['bukuID']) ?>"
                            class="btn btn-sm btn-danger flex-fill">
                            Favorit
                        </a>

                        <?php if ($row['status'] == 'Tersedia') { ?>

                            <a href="<?= base_url('peminjam/buku/ajukan/' . $row['bukuID']) ?>"
                                class="btn btn-sm btn-warning flex-fill">
                                Pinjam
                            </a>

                        <?php } else { ?>

                            <button class="btn btn-sm btn-secondary flex-fill" disabled>
                                Pinjam
                            </button>

                        <?php } ?>

                        <button type="button" class="btn btn-sm btn-info flex-fill" data-bs-toggle="modal"
                            data-bs-target="#modalUlasan<?= $row['bukuID'] ?>">
                            Review
                        </button>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>

</div>

<?php foreach ($buku as $row) { ?>

    <div class="modal fade" id="detail<?= $row['bukuID']; ?>">

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Detail Buku

                    </h5>

                    <button class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <?php if ($row['cover']) { ?>

                                <img src="<?= base_url('sneat/assets/upload/cover/' . $row['cover']) ?>"
                                    class="img-fluid rounded">

                            <?php } ?>

                        </div>

                        <div class="col-md-8">

                            <h3>

                                <?= $row['judul']; ?>

                            </h3>

                            <table class="table">

                                <tr>
                                    <th>Penulis</th>
                                    <td><?= $row['penulis']; ?></td>
                                </tr>

                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $row['namaKategori']; ?></td>
                                </tr>

                                <tr>
                                    <th>Penerbit</th>
                                    <td><?= $row['penerbit']; ?></td>
                                </tr>

                                <tr>
                                    <th>Tahun</th>
                                    <td><?= $row['tahunTerbit']; ?></td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td><?= $row['status']; ?></td>
                                </tr>

                            </table>

                            <h5>

                                ⭐ <?= $row['ratingRata']; ?>

                                <small class="text-muted">

                                    (<?= $row['totalReview']; ?> Review)

                                </small>

                            </h5>

                        </div>

                    </div>

                    <hr>

                    <h4 class="mb-3">

                        Review Pembaca

                    </h4>

                    <?php if (!empty($row['reviews'])) { ?>

                        <?php foreach ($row['reviews'] as $r) { ?>

                            <div class="review-box mb-3">

                                <div class="d-flex align-items-center mb-2">

                                    <?php if (!empty($r['foto'])) { ?>

                                        <img src="<?= base_url('sneat/assets/upload/user/' . $r['foto']) ?>" class="review-user-img me-2">

                                    <?php } else { ?>

                                        <div class="review-user-img me-2" style="
                background:#d9dee3;
                display:flex;
                align-items:center;
                justify-content:center;
            ">
                                            👤
                                        </div>

                                    <?php } ?>

                                    <div>

                                        <strong>

                                            <?= $r['nama']; ?>

                                        </strong>

                                    </div>

                                </div>

                                <div class="text-warning mb-2">

                                    <?php for ($i = 1; $i <= 5; $i++) { ?>

                                        <?= ($i <= $r['rating']) ? '★' : '☆'; ?>

                                    <?php } ?>

                                </div>

                                <div>

                                    <?= $r['ulasan']; ?>

                                </div>

                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <div class="alert alert-light border">

                            Belum ada ulasan untuk buku ini.

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

<?php foreach ($buku as $row) { ?>

    <div class="modal fade" id="modalUlasan<?= $row['bukuID'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?= base_url('peminjam/ulasan/simpan') ?>" method="post">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="bukuID" value="<?= $row['bukuID'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="">Pilih Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ulasan</label>
                            <textarea name="ulasan" class="form-control" rows="4" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<?php } ?>
