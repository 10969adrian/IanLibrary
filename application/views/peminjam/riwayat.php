<?php $today = date('Y-m-d'); ?>
<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="card mb-3 p-3">
    <form method="get" action="<?= base_url('peminjam/peminjaman') ?>">
        <div class="row g-2">

            <div class="col-md">
                <input type="text" name="judul" class="form-control" placeholder="Cari Judul"
                    value="<?= $this->input->get('judul'); ?>">
            </div>

            <div class="col-md">
                <select name="status" class="form-control">
                    <option value="">Status</option>
                    <option value="Proses">Proses</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="col-md-auto">
                <a href="<?= base_url('peminjam/peminjaman') ?>" class="btn btn-secondary">
                    Reset
                </a>
            </div>

            <div class="col-md-auto">
                <button class="btn btn-primary">Cari</button>
            </div>

        </div>
    </form>
</div>

<div class="card">
    <h5 class="card-header">Data Riwayat Peminjaman</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($riwayat)) { ?>
                    <?php $no = 1;
                    foreach ($riwayat as $row) { ?>

                        <tr>
                            <td><?= $no++; ?></td>

                            <td><?= $row['judul']; ?></td>

                            <td><?= $row['tanggalPeminjaman']; ?></td>

                            <td>
                                <?php if (!empty($row['tanggalPengembalian'])) { ?>

                                    <?= $row['tanggalPengembalian']; ?>

                                <?php } else { ?>

                                    <span class="text-muted">-</span>

                                <?php } ?>
                            </td>

                            <td>
                                <?php $status = $row['statusPeminjaman']; ?>

                                <?php if ($status == 'Proses') { ?>
                                    <span class="badge bg-warning text-dark">Proses</span>

                                <?php } elseif ($status == 'Dipinjam') { ?>
                                    <span class="badge bg-primary">Dipinjam</span>

                                <?php } elseif ($status == 'Pengembalian Diajukan') { ?>
                                    <span class="badge bg-info">
                                        Pengembalian Diajukan
                                    </span>

                                <?php } elseif ($status == 'Dikembalikan') { ?>
                                    <span class="badge bg-success">Selesai</span>

                                <?php } elseif ($status == 'Ditolak') { ?>
                                    <span class="badge bg-danger">Ditolak</span>

                                <?php } else { ?>
                                    <span class="badge bg-secondary">Dibatalkan</span>

                                <?php } ?>
                            </td>

                            <td>
                                <?php if ($status == 'Proses') { ?>

                                    <a href="<?= base_url('peminjam/peminjaman/batal/' . $row['peminjamanID']) ?>"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau batalkan?')">

                                        Batalkan

                                    </a>

                                <?php } elseif ($status == 'Dipinjam') { ?>

                                    <!-- <a href="<?= base_url('peminjam/peminjaman/ajukan_kembali/' . $row['peminjamanID']) ?>"
                                       class="btn btn-sm btn-warning"
                                       onclick="return confirm('Ajukan pengembalian buku ini?')">

                                       Ajukan Kembali

                                    </a> -->
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalKembali<?= $row['peminjamanID'] ?>">
                                        Ajukan Kembali
                                    </button>
                                <?php } else { ?>

                                    <span class="text-muted">-</span>

                                <?php } ?>
                            </td>
                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>

                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
<?php foreach ($riwayat as $row) { ?>
    <?php

    $tanggalPinjam = strtotime($row['tanggalPeminjaman']);

    $jatuhTempo = !empty($row['tanggalJatuhTempo'])
        ? strtotime($row['tanggalJatuhTempo'])
        : strtotime('+7 days', $tanggalPinjam);

    $hariIni = strtotime($today);

    $lamaPinjam = floor(($hariIni - $tanggalPinjam) / (60 * 60 * 24));

    if ($lamaPinjam < 0) {
        $lamaPinjam = 0;
    }

    $telat = 0;

    if ($hariIni > $jatuhTempo) {

        $telat = floor(($hariIni - $jatuhTempo) / (60 * 60 * 24));

    }

    $denda = $telat * 2000;

    ?>

    <div class="modal fade" id="modalKembali<?= $row['peminjamanID'] ?>" tabindex="-1">

        <div class="modal-dialog">
            <div class="modal-content">

                <form action="<?= base_url('peminjam/peminjaman/ajukan_kembali/' . $row['peminjamanID']) ?>" method="post">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Rincian Pengembalian
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <strong>Judul Buku</strong><br>
                            <?= $row['judul']; ?>
                        </div>

                        <div class="mb-3">
                            <strong>Tanggal Pinjam</strong><br>
                            <?= $row['tanggalPeminjaman']; ?>
                        </div>

                        <div class="mb-3">
                            <strong>Jatuh Tempo (Max 7 Hari)</strong><br>
                            <?= date('Y-m-d', $jatuhTempo); ?>
                        </div>

                        <div class="mb-3">
                            <strong>Lama Dipinjam</strong><br>
                            <?= $lamaPinjam; ?> Hari
                        </div>

                        <div class="mb-3">

                            <strong>Keterlambatan</strong><br>

                            <?php if ($telat > 0) { ?>

                                <span class="text-danger">
                                    <?= $telat; ?> Hari
                                </span>

                            <?php } else { ?>

                                <span class="text-success">
                                    Tidak Terlambat
                                </span>

                            <?php } ?>

                        </div>

                        <div class="mb-3">

                            <strong>Estimasi Denda</strong><br>

                            <?php if ($denda > 0) { ?>

                                <span class="text-danger fw-bold">
                                    Rp <?= number_format($denda, 0, ',', '.'); ?>
                                </span>

                            <?php } else { ?>

                                <span class="text-success fw-bold">
                                    Rp 0
                                </span>

                            <?php } ?>

                        </div>

                        <small class="text-muted">
                            *Maksimal peminjaman 7 hari<br>
                            *Denda keterlambatan Rp2.000 / hari<br>
                            <!-- *Denda final akan dikonfirmasi admin<br> -->
                            *Denda dibayar saat mengembalikan buku ke Perpustakaan
                        </small>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit" class="btn btn-primary">

                            Ajukan Pengembalian

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

<?php } ?>
