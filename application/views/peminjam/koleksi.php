<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="card mb-3 p-3">

    <form method="get" action="<?= base_url('peminjam/koleksi') ?>">

        <div class="row g-2 align-items-end">

            <div class="col-md">
                <input type="text" name="judul" class="form-control"
                       placeholder="Judul"
                       value="<?= $this->input->get('judul'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="penulis" class="form-control"
                       placeholder="Penulis"
                       value="<?= $this->input->get('penulis'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="kategori" class="form-control"
                       placeholder="Kategori"
                       value="<?= $this->input->get('kategori'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="penerbit" class="form-control"
                       placeholder="Penerbit"
                       value="<?= $this->input->get('penerbit'); ?>">
            </div>

            <div class="col-md">
                <input type="number" name="tahun" class="form-control"
                       placeholder="Tahun"
                       value="<?= $this->input->get('tahun'); ?>">
            </div>

            <div class="col-md-auto">
                <a href="<?= base_url('peminjam/koleksi') ?>"
                   class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>

            <div class="col-md-auto">
                <button class="btn btn-primary">
                    Cari
                </button>
            </div>

        </div>

    </form>

</div>

<style>

.book-card{
    border:none;
    border-radius:16px;
    overflow:hidden;
    transition:.2s;
}

.book-card:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 20px rgba(67,89,113,.12);
}

.book-cover{
    width:100%;
    aspect-ratio:3/4;
    object-fit:cover;
    background:#f5f5f9;
}

.book-title{
    font-size:14px;
    font-weight:700;
    line-height:1.4;

    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;

    min-height:40px;
}

.book-author{
    font-size:12px;
    color:#697a8d;
}

.book-rating{
    color:#f5c518;
    font-size:13px;
}

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

</style>

<div class="row g-3">

<?php foreach($koleksi as $row){ ?>

<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

    <div class="card book-card h-100">

        <div
            data-bs-toggle="modal"
            data-bs-target="#detail<?= $row['bukuID']; ?>"
            style="cursor:pointer;"
        >

            <?php if($row['cover']){ ?>

                <img
                    src="<?= base_url('sneat/assets/upload/cover/'.$row['cover']) ?>"
                    class="book-cover"
                >

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

            <div class="d-grid">

                <a
                    href="<?= base_url('peminjam/koleksi/hapus/'.$row['koleksiID']) ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Hapus dari favorit?')"
                >
                    Hapus Favorit
                </a>

            </div>

        </div>

    </div>

</div>

<?php } ?>

</div>