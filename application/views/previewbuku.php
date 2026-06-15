<style>

.book-card{
    border:none;
    border-radius:16px;
    overflow:hidden;
    cursor:pointer;
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

    display:-webkit-box;
    -webkit-line-clamp:1;
    -webkit-box-orient:vertical;
    overflow:hidden;
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

<div class="card mb-4 p-3">

    <form method="get" action="<?= base_url('previewbuku') ?>">

        <div class="row g-2 align-items-end">

            <div class="col-md">

                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    placeholder="Judul"
                    value="<?= $this->input->get('judul'); ?>"
                >

            </div>

            <div class="col-md">

                <input
                    type="text"
                    name="penulis"
                    class="form-control"
                    placeholder="Penulis"
                    value="<?= $this->input->get('penulis'); ?>"
                >

            </div>

            <div class="col-md">

                <select name="kategori" class="form-control">

                    <option value="">
                        Kategori
                    </option>

                    <?php foreach($kategori as $k){ ?>

                        <option
                            value="<?= $k['namaKategori']; ?>"
                            <?= ($this->input->get('kategori') == $k['namaKategori']) ? 'selected' : ''; ?>
                        >

                            <?= $k['namaKategori']; ?>

                        </option>

                    <?php } ?>

                </select>

            </div>

            <div class="col-md">

                <input
                    type="text"
                    name="penerbit"
                    class="form-control"
                    placeholder="Penerbit"
                    value="<?= $this->input->get('penerbit'); ?>"
                >

            </div>

            <div class="col-md">

                <input
                    type="number"
                    name="tahun"
                    class="form-control"
                    placeholder="Tahun"
                    value="<?= $this->input->get('tahun'); ?>"
                >

            </div>

            <div class="col-md">

                <select name="status" class="form-control">

                    <option value="">
                        Status
                    </option>

                    <option
                        value="Tersedia"
                        <?= ($this->input->get('status') == 'Tersedia') ? 'selected' : ''; ?>
                    >

                        Tersedia

                    </option>

                    <option
                        value="Dipinjam"
                        <?= ($this->input->get('status') == 'Dipinjam') ? 'selected' : ''; ?>
                    >

                        Dipinjam

                    </option>

                </select>

            </div>

            <div class="col-md-auto">

                <a
                    href="<?= base_url('previewbuku') ?>"
                    class="btn btn-outline-secondary w-100"
                >

                    Reset

                </a>

            </div>

            <div class="col-md-auto">

                <button
                    class="btn btn-primary w-100"
                >

                    Cari

                </button>

            </div>

        </div>

    </form>

</div>

<div class="row g-3">

<?php foreach($buku as $b){ ?>

    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex">

        <div
            class="card book-card w-100"
            data-bs-toggle="modal"
            data-bs-target="#detail<?= $b['bukuID']; ?>"
        >

            <?php if($b['cover']){ ?>

                <img
                    src="<?= base_url('sneat/assets/upload/cover/'.$b['cover']) ?>"
                    class="book-cover"
                >

            <?php } ?>

            <div class="card-body d-flex flex-column">

                <div class="book-title">

                    <?= $b['judul']; ?>

                </div>

                <div class="book-author mb-2">

                    <?= $b['penulis']; ?>

                </div>

                <div class="mt-auto d-flex justify-content-between align-items-center">

                    <span class="book-rating">

                        ★ <?= $b['ratingRata']; ?>

                    </span>

                    <span class="text-muted small">

                        <?= $b['totalReview']; ?> Review

                    </span>

                </div>

            </div>

        </div>

    </div>

<?php } ?>

</div>
<?php foreach($buku as $b){ ?>

<div
    class="modal fade"
    id="detail<?= $b['bukuID']; ?>"
>

    <div
        class="modal-dialog modal-xl modal-dialog-scrollable"
    >

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
                                <th width="150">
                                    Penulis
                                </th>
                                <td>
                                    <?= $b['penulis']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Kategori
                                </th>
                                <td>
                                    <?= $b['namaKategori']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Penerbit
                                </th>
                                <td>
                                    <?= $b['penerbit']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Tahun
                                </th>
                                <td>
                                    <?= $b['tahunTerbit']; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Status
                                </th>
                                <td>
                                    <?= $b['status']; ?>
                                </td>
                            </tr>

                        </table>

                        <div class="mt-3">

                            <h5>

                                ⭐ <?= $b['ratingRata']; ?>

                                <small class="text-muted">

                                    (<?= $b['totalReview']; ?> Review)

                                </small>

                            </h5>

                        </div>

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

                                <?php if($r['foto']){ ?>

                                    <img
                                        src="<?= base_url('sneat/assets/upload/user/'.$r['foto']) ?>"
                                        class="review-user-img me-2"
                                    >

                                <?php } else { ?>

                                    <div
                                        class="review-user-img me-2"
                                        style="background:#d9dee3;">
                                    </div>

                                <?php } ?>

                                <strong>

                                    <?= $r['nama']; ?>

                                </strong>

                            </div>

                            <div
                                style="
                                    color:#f5c518;
                                    font-size:18px;
                                "
                                class="mb-2"
                            >

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

</div>

<?php } ?>