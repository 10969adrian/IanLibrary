<style>

.scroll-row{
    display:flex;
    gap:14px;
    overflow-x:auto;
    padding-bottom:6px;
}

.scroll-row::-webkit-scrollbar{
    height:5px;
}

.scroll-row::-webkit-scrollbar-thumb{
    background:#dcdcdc;
    border-radius:10px;
}

.card-mini{
    min-width:170px;
    max-width:170px;
    flex:0 0 auto;
    border:none;
    overflow:hidden;
    transition:.25s;
}

.card-mini:hover{
    transform:translateY(-4px);
}

.card-mini img{
    height:230px;
    width:100%;
    object-fit:cover;
}

.card-mini .card-body{
    padding:12px;
}

.text-clamp{
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.mini-title{
    font-size:13px;
}

.hero-card{
    min-height:165px;
}

@media(max-width:991px){

    .card-mini{
        min-width:150px;
        max-width:150px;
    }

    .card-mini img{
        height:210px;
    }

}

</style>


<div class="row g-3 align-items-stretch">

    <!-- LEFT -->
    <div class="col-lg-8 d-flex flex-column">

        <!-- HERO -->
        <div class="card border-0 shadow-sm mb-3 hero-card">

            <div class="card-body text-center d-flex flex-column justify-content-center py-4 px-4">

                <h2 class="fw-bold mb-2">
                    Temukan Buku Favoritmu!
                </h2>

                <p class="text-muted small mb-3 mx-auto"
                   style="max-width:600px;">

                    Ian's Library menyediakan koleksi buku,
                    review pembaca, dan sistem peminjaman modern.

                </p>

                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <a href="<?= base_url('previewbuku') ?>"
                       class="btn btn-outline-primary btn-sm px-4">

                        Jelajahi Buku

                    </a>

                    <a href="<?= base_url('auth/register') ?>"
                       class="btn btn-primary btn-sm px-4x">

                        Mulai

                    </a>

                </div>

            </div>

        </div>


        <!-- STATISTIK -->
        <div class="row mb-3">

            <div class="col-md-4 mb-3">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body text-center py-3">

                        <i class="bx bx-book text-primary fs-3 mb-2"></i>

                        <h5 class="fw-bold mb-0">
                            <?= count($buku); ?>
                        </h5>

                        <small class="text-muted">
                            Buku
                        </small>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body text-center py-3">

                        <i class="bx bx-category text-primary fs-3 mb-2"></i>

                        <h5 class="fw-bold mb-0">
                            <?= count($kategori); ?>
                        </h5>

                        <small class="text-muted">
                            Kategori
                        </small>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-3">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body text-center py-3">

                        <i class="bx bx-star text-primary fs-3 mb-2"></i>

                        <h5 class="fw-bold mb-0">
                            <?= count($ulasan); ?>
                        </h5>

                        <small class="text-muted">
                            Review
                        </small>

                    </div>

                </div>

            </div>

        </div>


        <!-- MAP -->
        <div class="card border-0 shadow-sm flex-grow-1"
             id="lokasi">

            <div class="card-body p-3 d-flex flex-column">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h5 class="mb-0">
                        Lokasi Perpustakaan
                    </h5>

                    <small class="text-muted">
                        Banjarmasin
                    </small>

                </div>

                <div class="flex-grow-1"
                     style="min-height:420px;">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d559.3562770979054!2d113.91874870530381!3d-2.2876831179949364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de34da7d31adc15%3A0x1796312d5f906a8a!2sMama%20Ryan-Dira!5e0!3m2!1sid!2sid!4v1777737154664!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0; border-radius:14px;"
                        allowfullscreen=""
                        loading="lazy">

                    </iframe>

                </div>

            </div>

        </div>

    </div>


    <!-- RIGHT -->
    <div class="col-lg-4 d-flex flex-column">

        <!-- BUKU -->
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h5 class="mb-0">
                        Buku Terbaru
                    </h5>

                    <a href="<?= base_url('previewbuku') ?>"
                       class="small text-decoration-none">

                        Semua

                    </a>

                </div>

                <div class="scroll-row">

                    <?php foreach($buku as $row){ ?>

                        <div class="card card-mini shadow-sm">

                            <img src="<?= base_url('sneat/assets/upload/cover/'.$row['cover']) ?>">

                            <div class="card-body">

                                <div class="fw-semibold mini-title text-clamp mb-1">

                                    <?= $row['judul']; ?>

                                </div>

                                <small class="text-muted">

                                    <?= $row['penulis']; ?>

                                </small>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>


        <!-- REVIEW -->
        <div class="card border-0 shadow-sm flex-grow-1"
             id="review">

            <div class="card-body p-3 d-flex flex-column">

                <h5 class="mb-3">
                    Review Terbaru
                </h5>

                <div class="scroll-row">

                    <?php foreach($ulasan as $row){ ?>

                        <div class="card card-mini shadow-sm">

                            <img src="<?= base_url('sneat/assets/upload/cover/'.$row['cover']) ?>">

                            <div class="card-body">

                                <div class="fw-semibold mini-title mb-1">

                                    <?= $row['nama']; ?>

                                </div>

                                <div class="mb-1">

                                    <?php for($i=1;$i<=5;$i++){ ?>

                                        <span style="color:<?= ($i <= $row['rating']) ? '#f5c518' : '#ddd'; ?>; font-size:12px;">
                                            ★
                                        </span>

                                    <?php } ?>

                                </div>

                                <small class="text-muted text-clamp">

                                    <?= $row['ulasan']; ?>

                                </small>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>