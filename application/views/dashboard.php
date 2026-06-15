<?php if ($this->session->userdata('role') == 'Peminjam') { ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center py-4">

            <h3 class="fw-bold mb-2">
                Selamat Datang,
                <?= $this->session->userdata('nama'); ?>!
            </h3>

            <p class="text-muted">
                Kelola aktivitas membaca, peminjaman, dan koleksi favoritmu dengan mudah.
            </p>

        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-book text-primary fs-3 mb-2"></i>
                    <h4><?= $totalDipinjam ?></h4>
                    <small class="text-muted">Buku Dipinjam</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-bookmark text-primary fs-3 mb-2"></i>
                    <h4><?= $totalFavorit ?></h4>
                    <small class="text-muted">Buku Favorit</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-star text-primary fs-3 mb-2"></i>
                    <h4><?= $totalReviewUser ?></h4>
                    <small class="text-muted">Review Ditulis</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-book-reader text-primary fs-3 mb-2"></i>
                    <h4><?= $totalSelesai ?></h4>
                    <small class="text-muted">Buku Selesai Dibaca</small>
                </div>
            </div>
        </div>

    </div>
<?php } ?>
<?php if (
    $this->session->userdata('role') == 'Admin' ||
    $this->session->userdata('role') == 'Petugas'
) { ?>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center py-4">

            <h3 class="fw-bold mb-2">
                Selamat Datang <?= $this->session->userdata('role'); ?>
        <?= $this->session->userdata('nama'); ?>!
            </h3>

            <p class="text-muted">
                Kelola data perpustakaan dan pantau aktivitas pengguna dengan mudah.
            </p>

        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-book text-primary fs-3 mb-2"></i>
                    <h4><?= $totalBuku ?></h4>
                    <small class="text-muted">Total Buku</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-category text-primary fs-3 mb-2"></i>
                    <h4><?= $totalKategori ?></h4>
                    <small class="text-muted">Total Kategori</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-book-reader text-primary fs-3 mb-2"></i>
                    <h4><?= $totalPeminjamanAktif ?></h4>
                    <small class="text-muted">Peminjaman Aktif</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-user text-primary fs-3 mb-2"></i>
                    <h4><?= $totalUser ?></h4>
                    <small class="text-muted">Total User</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <i class="bx bx-star text-primary fs-3 mb-2"></i>
                    <h4><?= $totalReviewAdmin ?></h4>
                    <small class="text-muted">Total Review</small>
                </div>
            </div>
        </div>

    </div>

<?php } ?>

<!-- STYLE biar rapi -->
<style>
    .review-user-img{
width:35px;
height:35px;
border-radius:50%;
object-fit:cover;
}

.review-box{
border:1px solid #ebeef2;
border-radius:12px;
padding:12px;
}

    .scroll-row {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .card-mini{
    min-width:190px;
    max-width:100px;
    height:390px; 
}

.card-mini .card-body{
    display:flex;
    flex-direction:column;
}

    .card-mini img {
        height: 240px;
        object-fit: cover;
    }

    .text-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 55px;
    }

    .btn-icon {
        width: 50px;
        height: 50px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-mini .btn {
        font-size: 11px;
        padding: 3px 6px;
        line-height: 1.2;
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

    .book-cover {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
    }

    .card-mini .btn {
        font-size: 11px;
        padding: 4px 6px;
    }
</style>
<div class="row">
    <div class="col-lg-6">
        <!-- ========================= -->
        <!-- 📚 BUKU TERBARU -->
        <!-- ========================= -->
        <h5 class="mt-4 mb-2">Buku Terbaru</h5>

        <div class="scroll-row">

            <?php foreach ($buku as $b) { ?>

                <div class="card card-mini shadow-sm d-flex flex-column" data-bs-toggle="modal"
    data-bs-target="#detail<?= $b['bukuID']; ?>"
    style="cursor:pointer;">

                    <img src="<?= base_url('sneat/assets/upload/cover/' . $b['cover']) ?>" class="book-cover">

                    <div class="card-body p-2 d-flex flex-column">

                        <!-- JUDUL -->
                        <div class="book-title"
    data-bs-toggle="modal"
    data-bs-target="#detail<?= $b['bukuID']; ?>"
    style="cursor:pointer;">

                            <?= $b['judul']; ?>

                        </div>

                        <!-- PENULIS -->
                        <div class="book-author mb-2">

                            <?= $b['penulis']; ?>

                        </div>

                        <!-- RATING -->
                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="book-rating">

                                ★ <?= $b['ratingRata']; ?>

                            </span>

                            <span class="text-muted small">

                                <?= $b['totalReview']; ?> Review

                            </span>

                        </div>

                        <?php if ($this->session->userdata('role') == 'Peminjam') { ?>

                            <div class="d-flex gap-1 mt-auto">

                                <a href="<?= site_url('peminjam/koleksi/tambah/' . $b['bukuID']) ?>"
                                    class="btn btn-sm btn-danger flex-fill">
                                    Favorit
                                </a>

                                <?php if ($b['status'] == 'Tersedia') { ?>

                                    <a href="<?= base_url('peminjam/buku/ajukan/' . $b['bukuID']) ?>"
                                        class="btn btn-sm btn-warning flex-fill">
                                        Pinjam
                                    </a>

                                <?php } else { ?>

                                    <button class="btn btn-sm btn-secondary flex-fill" disabled>
                                        Pinjam
                                    </button>

                                <?php } ?>

                                <button class="btn btn-sm btn-info flex-fill" data-bs-toggle="modal"
                                    data-bs-target="#modalUlasan<?= $b['bukuID'] ?>">
                                    Review
                                </button>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

        </div>
    </div>

    <div class="col-lg-6">
        <h5 class="mt-4 mb-2">
            Rekomendasi Untukmu
        </h5>

        <div class="scroll-row">

            <?php foreach ($rekomendasi as $b) { ?>

                <div class="card card-mini shadow-sm d-flex flex-column" data-bs-toggle="modal"
    data-bs-target="#detail<?= $b['bukuID']; ?>"
    style="cursor:pointer;">

                    <img src="<?= base_url('sneat/assets/upload/cover/' . $b['cover']) ?>" class="book-cover">

                    <div class="card-body p-2 d-flex flex-column">

                        <div class="book-title"
    data-bs-toggle="modal"
    data-bs-target="#detail<?= $b['bukuID']; ?>"
    style="cursor:pointer;">

                            <?= $b['judul']; ?>

                        </div>

                        <div class="book-author mb-2">

                            <?= $b['penulis']; ?>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="book-rating">

                                ★ <?= round($b['rating_rata'], 1); ?>

                            </span>

                            <span class="text-muted small">

                                <?= $b['jumlah_review']; ?> Review

                            </span>

                        </div>

                        <?php if ($this->session->userdata('role') == 'Peminjam') { ?>

                            <div class="d-flex gap-1 mt-auto">

                                <a href="<?= site_url('peminjam/koleksi/tambah/' . $b['bukuID']) ?>"
                                    class="btn btn-sm btn-danger flex-fill">
                                    Favorit
                                </a>

                                <?php if ($b['status'] == 'Tersedia') { ?>

                                    <a href="<?= base_url('peminjam/buku/ajukan/' . $b['bukuID']) ?>"
                                        class="btn btn-sm btn-warning flex-fill">
                                        Pinjam
                                    </a>

                                <?php } else { ?>

                                    <button class="btn btn-sm btn-secondary flex-fill" disabled>
                                        Pinjam
                                    </button>

                                <?php } ?>

                                <button class="btn btn-sm btn-info flex-fill" data-bs-toggle="modal"
                                    data-bs-target="#modalUlasan<?= $b['bukuID'] ?>">
                                    Review
                                </button>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

        </div>
    </div>
</div>

<?php foreach($buku as $b){ ?>

<div
    class="modal fade"
    id="detail<?= $b['bukuID']; ?>"
>

```
<div class="modal-dialog modal-xl modal-dialog-scrollable">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title">
                Detail Buku
            </h5>

            <button
                class="btn-close"
                data-bs-dismiss="modal">
            </button>

        </div>

        <div class="modal-body">

            <div class="row">

                <div class="col-md-4">

                    <?php if($b['cover']){ ?>

                        <img
                            src="<?= base_url('sneat/assets/upload/cover/'.$b['cover']) ?>"
                            class="img-fluid rounded"
                        >

                    <?php } ?>

                </div>

                <div class="col-md-8">

                    <h3>
                        <?= $b['judul']; ?>
                    </h3>

                    <table class="table">

                        <tr>
                            <th>Penulis</th>
                            <td><?= $b['penulis']; ?></td>
                        </tr>

                        <tr>
                            <th>Kategori</th>
                            <td><?= $b['namaKategori']; ?></td>
                        </tr>

                        <tr>
                            <th>Penerbit</th>
                            <td><?= $b['penerbit']; ?></td>
                        </tr>

                        <tr>
                            <th>Tahun</th>
                            <td><?= $b['tahunTerbit']; ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td><?= $b['status']; ?></td>
                        </tr>

                    </table>

                    <h5>

                        ⭐ <?= $b['ratingRata']; ?>

                        <small class="text-muted">

                            (<?= $b['totalReview']; ?> Review)

                        </small>

                    </h5>

                </div>

            </div>

            <hr>

            <h4 class="mb-3">

                Review Pembaca

            </h4>

            <?php if(!empty($b['reviews'])){ ?>

                <?php foreach($b['reviews'] as $r){ ?>

                    <div class="review-box mb-3">

                        <div class="d-flex align-items-center mb-2">

                            <?php if(!empty($r['foto'])){ ?>

                                <img
                                    src="<?= base_url('sneat/assets/upload/user/'.$r['foto']) ?>"
                                    class="review-user-img me-2"
                                >

                            <?php } else { ?>

                                <div
                                    class="review-user-img me-2"
                                    style="
                                        background:#d9dee3;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >
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

                            <?php for($i=1;$i<=5;$i++){ ?>

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
```

</div>

<?php } ?>

<!-- 🔥 MODAL REMINDER JATUH TEMPO -->
<?php if (!empty($notifJatuhTempo)) { ?>

    <div class="modal fade" id="modalReminder" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius:18px;">

                <!-- HEADER -->
                <div class="modal-header border-0 bg-warning py-3 px-4 position-relative">

                    <h5 class="modal-title fw-bold text-white w-100 text-center m-0 justify-content-center">
                        Buku yang kamu pinjam akan jatuh tempo besok!
                    </h5>
                </div>

                <!-- BODY -->
                <div class="modal-body p-4 text-center">

                    <?php foreach ($notifJatuhTempo as $n) { ?>
                        <!-- TEXT -->
                        <div class="mb-3 fs-5">
                            <b><?= $n['judul']; ?></b>
                        </div>

                        <hr>

                        <!-- ALERT -->
                        <div class="text-muted fs-5">

                            Segera lakukan pengembalian
                            agar tidak terkena denda

                            <br>

                            <span class="fw-bold text-warning">
                                Rp2.000/hari
                            </span>

                        </div>

                    <?php } ?>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 justify-content-center pb-4 gap-2">

                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">

                        Nanti

                    </button>

                    <a href="<?= base_url('peminjam/peminjaman') ?>" class="btn btn-warning px-4 py-2 text-white">

                        Lihat Peminjaman

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- 🔥 AUTO SHOW -->
    <script>

        document.addEventListener("DOMContentLoaded", function () {

            var modalReminder = new bootstrap.Modal(
                document.getElementById('modalReminder')
            );

            modalReminder.show();

        });

    </script>

<?php } ?>

<!-- 🔥 MODAL TERLAMBAT -->
<?php if (!empty($notifTerlambat)) { ?>

    <div class="modal fade" id="modalTerlambat" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius:18px;">

                <!-- HEADER -->
                <div class="modal-header border-0 bg-danger py-3 px-4 justify-content-center">

                    <h5 class="modal-title text-white fw-bold m-0">
                        Kamu udah ngelewatin tempo
                        peminjaman buku ini!
                    </h5>
                </div>

                <!-- BODY -->
                <div class="modal-body p-4 text-center">

                    <?php foreach ($notifTerlambat as $n) { ?>

                        <?php

                        $jatuhTempo = date(
                            'Y-m-d',
                            strtotime($n['tanggalPeminjaman'] . ' +7 days')
                        );

                        $hariTelat = floor(
                            (strtotime(date('Y-m-d')) - strtotime($jatuhTempo))
                            / (60 * 60 * 24)
                        );

                        $denda = $hariTelat * 2000;

                        ?>

                        <!-- JUDUL -->
                        <div class="mb-3 fs-5">

                            <b><?= $n['judul']; ?></b>

                        </div>

                        <!-- INFO -->
                        <div class="alert alert-danger border-0">

                            Terlambat
                            <b><?= $hariTelat; ?> hari</b>

                            <br>

                            Denda saat ini:
                            <b>
                                Rp<?= number_format($denda, 0, ',', '.'); ?>
                            </b>

                        </div>

                        <hr>
                        <div class="text-muted fs-5">

                            Segera lakukan pengembalian
                            agar denda tidak bertambah!

                            <br>
                        </div>

                    <?php } ?>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer border-0 justify-content-center pb-4">

                    <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal">

                        Nanti

                    </button>

                    <a href="<?= base_url('peminjam/peminjaman') ?>" class="btn btn-danger px-4 py-2">

                        Lihat Peminjaman

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- 🔥 AUTO SHOW -->
    <script>

        document.addEventListener("DOMContentLoaded", function () {

            var modalTerlambat = new bootstrap.Modal(
                document.getElementById('modalTerlambat')
            );

            modalTerlambat.show();

        });

    </script>

<?php } ?>

<?php foreach ($buku as $b) { ?>

    <div class="modal fade" id="modalUlasan<?= $b['bukuID'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?= base_url('peminjam/ulasan/simpan') ?>" method="post">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="bukuID" value="<?= $b['bukuID'] ?>">

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