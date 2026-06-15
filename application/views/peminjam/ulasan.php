<style>
.review-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.review-img {
    width: 100%;
    aspect-ratio: 3/4;
    object-fit: cover;
}

.review-body {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.review-text {
    font-size: 12px;
    min-height: 55px;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<?= $this->session->flashdata('notifikasi', TRUE); ?>
<!-- 
<div class="mb-3">
    <h4>Review Buku</h4>
</div> -->

<div class="row">

<?php foreach($ulasan as $u){ ?>

    <div class="col-md-2 mb-2 d-flex">

        <div class="card shadow-sm review-card w-100" style="font-size:13px;">

            <!-- 📕 COVER -->
            <img src="<?= base_url('sneat/assets/upload/cover/'.$u['cover']) ?>"
                 class="review-img card-img-top">

            <div class="card-body p-2 review-body">

                <!-- 👤 USER -->
                <div class="d-flex align-items-center gap-2 mb-1">
                    <?php if($u['foto']){ ?>
                        <img src="<?= base_url('sneat/assets/upload/user/'.$u['foto']) ?>"
                             style="width:26px;height:26px;border-radius:50%;object-fit:cover;">
                    <?php } else { ?>
                        <div style="width:26px;height:26px;border-radius:50%;background:#ccc;"></div>
                    <?php } ?>

                    <small style="font-size:12px;">
                        <b><?= $u['nama']; ?></b>
                    </small>
                </div>

                <!-- ⭐ RATING -->
                <div class="mb-1" style="font-size:14px;">
                    <?php for($i=1;$i<=5;$i++){ ?>
                        <span style="color:<?= ($i <= $u['rating']) ? '#f5c518' : '#ddd'; ?>">★</span>
                    <?php } ?>
                </div>

                <!-- 💬 ULASAN -->
                <div class="review-text">
                    <?= $u['ulasan']; ?>
                </div>

                <!-- 📌 JUDUL -->
                <small class="text-muted mt-auto d-block">
                    <?= $u['judul']; ?>
                </small>

                <!-- ✏️ ACTION -->
                <?php if($u['userID'] == $this->session->userdata('userID')){ ?>

                    <div class="mt-2 d-flex gap-1 justify-content-center">

                        <a href="<?= base_url('peminjam/ulasan/edit/'.$u['ulasanID']) ?>"
                           class="btn btn-sm btn-warning py-0 px-2"
                           style="font-size:11px;">
                            Edit
                        </a>

                        <a href="<?= base_url('peminjam/ulasan/hapus/'.$u['ulasanID']) ?>"
                           class="btn btn-sm btn-danger py-0 px-2"
                           style="font-size:11px;"
                           onclick="return confirm('Hapus ulasan ini?')">
                            Hapus
                        </a>

                    </div>

                <?php } ?>

            </div>
        </div>

    </div>

<?php } ?>

</div>