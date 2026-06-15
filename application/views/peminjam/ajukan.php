<?= $this->session->flashdata('notifikasi',TRUE); ?>

<div class="card p-4">
    <form action="<?= base_url('peminjam/peminjaman/ajukan/'.$buku->bukuID) ?>" method="post">

        <div class="row">
            
            <!-- KIRI -->
            <div class="col-md-8">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" readonly value="<?= $buku->judul; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" class="form-control" readonly value="<?= $buku->penulis; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" class="form-control" readonly 
                        value="<?php 
                            foreach($kategori as $k){
                                if($k['kategoriID'] == $buku->kategoriID){
                                    echo $k['namaKategori'];
                                }
                            }
                        ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text" class="form-control" readonly value="<?= $buku->penerbit; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="text" class="form-control" readonly value="<?= $buku->tahunTerbit; ?>">
                </div>

                <!-- 🔥 sekarang tanggal optional -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Peminjaman</label>
                    <input type="date" name="tanggalPeminjaman" class="form-control">
                </div>

                <div class="mt-3">
                    <a href="<?= base_url('peminjam/buku') ?>" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Ajukan Peminjaman
                    </button>
                </div>

            </div>

            <!-- KANAN -->
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