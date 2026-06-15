<?= $this->session->flashdata('notifikasi', TRUE); ?>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalLaporan">
    Laporan Peminjaman
</button>

<div class="card mb-3 p-3">

    <form method="get" action="<?= base_url('admin/peminjaman') ?>">
        <div class="row g-2">

            <div class="col-md">
                <input type="text" name="nama" class="form-control" placeholder="Cari Nama"
                    value="<?= $this->input->get('nama'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="judul" class="form-control" placeholder="Cari Judul"
                    value="<?= $this->input->get('judul'); ?>">
            </div>

            <div class="col-md">
                <select name="status" class="form-control">
                    <option value="">Status</option>
                    <option value="Proses">Proses</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Pengembalian Diajukan">Pengembalian Diajukan</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="col-md-auto">
                <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-secondary">
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
    <h5 class="card-header">Data Peminjaman</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Jatuh Tempo</th>
                    <th>Denda</th>
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

                            <td><?= $row['nama']; ?></td>

                            <td><?= $row['judul']; ?></td>

                            <td><?= $row['tanggalPeminjaman']; ?></td>

                            <td>
                                <?= !empty($row['tanggalPengembalian'])
                                    ? $row['tanggalPengembalian']
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($row['tanggalJatuhTempo'])
                                    ? $row['tanggalJatuhTempo']
                                    : '-' ?>
                            </td>

                            <td>

                                <?php

                                $tanggalPinjam = strtotime($row['tanggalPeminjaman']);

                                $jatuhTempo = !empty($row['tanggalJatuhTempo'])
                                    ? strtotime($row['tanggalJatuhTempo'])
                                    : strtotime('+7 days', $tanggalPinjam);

                                $tanggalAcuan = !empty($row['tanggalPengembalian'])
                                    ? strtotime($row['tanggalPengembalian'])
                                    : strtotime(date('Y-m-d'));

                                $telat = 0;

                                if ($tanggalAcuan > $jatuhTempo) {

                                    $telat = floor(
                                        ($tanggalAcuan - $jatuhTempo)
                                        / (60 * 60 * 24)
                                    );

                                }

                                $dendaTabel = $telat * 2000;

                                if ($dendaTabel > 0) { ?>

                                    <span class="text-danger fw-bold">
                                        Rp <?= number_format($dendaTabel, 0, ',', '.'); ?>
                                    </span>

                                <?php } else { ?>

                                    <span class="text-success">
                                        Rp 0
                                    </span>

                                <?php } ?>

                            </td>

                            <td>

                                <?php $status = $row['statusPeminjaman']; ?>

                                <?php if ($status == 'Proses') { ?>

                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>

                                <?php } elseif ($status == 'Dipinjam') { ?>

                                    <span class="badge bg-primary">
                                        Dipinjam
                                    </span>

                                <?php } elseif ($status == 'Pengembalian Diajukan') { ?>

                                    <span class="badge bg-info text-dark">
                                        Pengembalian
                                    </span>

                                <?php } elseif ($status == 'Dikembalikan') { ?>

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                <?php } elseif ($status == 'Ditolak') { ?>

                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>

                                <?php } else { ?>

                                    <span class="badge bg-secondary">
                                        Dibatalkan
                                    </span>

                                <?php } ?>

                            </td>

                            <td>

                                <?php if ($status == 'Proses') { ?>

                                    <a href="<?= base_url('admin/peminjaman/terima/' . $row['peminjamanID']) ?>"
                                        class="btn btn-sm btn-success" onclick="return confirm('Terima pengajuan?')">

                                        Terima

                                    </a>

                                    <a href="<?= base_url('admin/peminjaman/tolak/' . $row['peminjamanID']) ?>"
                                        class="btn btn-sm btn-danger" onclick="return confirm('Tolak pengajuan?')">

                                        Tolak

                                    </a>

                                <?php } elseif ($status == 'Dipinjam') { ?>

                                    <span class="text-muted">-</span>

                                <?php } elseif ($status == 'Pengembalian Diajukan') { ?>

                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalKembali<?= $row['peminjamanID'] ?>">

                                        Konfirmasi Kembali

                                    </button>

                                <?php } else { ?>

                                    <span class="text-muted">-</span>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="9" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Filter Laporan Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="get" action="<?= base_url('admin/laporan') ?>">

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="Proses">Proses</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Pengembalian Diajukan">Pengembalian Diajukan</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit" class="btn btn-primary">

                        Buat

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<?php foreach ($riwayat as $row) { ?>

    <?php

    $tanggalPinjam = strtotime($row['tanggalPeminjaman']);

    $jatuhTempo = !empty($row['tanggalJatuhTempo'])
        ? strtotime($row['tanggalJatuhTempo'])
        : strtotime('+7 days', $tanggalPinjam);

    $hariIni = strtotime(date('Y-m-d'));

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

    <div class="modal" id="modalKembali<?= $row['peminjamanID'] ?>" tabindex="-1">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Konfirmasi Pengembalian
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <strong>Nama Peminjam</strong><br>
                        <?= $row['nama']; ?>
                    </div>

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

                        <strong>Denda Final</strong><br>

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
                        Maksimal peminjaman 7 hari<br>
                        Denda keterlambatan Rp2.000 / hari
                    </small>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                        Batal

                    </button>

                    <a href="<?= base_url('admin/peminjaman/kembalikan/' . $row['peminjamanID']) ?>" class="btn btn-primary">

                        Konfirmasi Pengembalian

                    </a>

                </div>

            </div>
        </div>
    </div>

<?php } ?><?= $this->session->flashdata('notifikasi', TRUE); ?>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalLaporan">
    Laporan Peminjaman
</button>

<div class="card mb-3 p-3">

    <form method="get" action="<?= base_url('admin/peminjaman') ?>">
        <div class="row g-2">

            <div class="col-md">
                <input type="text" name="nama" class="form-control"
                    placeholder="Cari Nama"
                    value="<?= $this->input->get('nama'); ?>">
            </div>

            <div class="col-md">
                <input type="text" name="judul" class="form-control"
                       placeholder="Cari Judul"
                       value="<?= $this->input->get('judul'); ?>">
            </div>

            <div class="col-md">
                <select name="status" class="form-control">
                    <option value="">Status</option>
                    <option value="Proses">Proses</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Pengembalian Diajukan">Pengembalian Diajukan</option>
                    <option value="Dikembalikan">Dikembalikan</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <div class="col-md-auto">
                <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-secondary">
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
    <h5 class="card-header">Data Peminjaman</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Jatuh Tempo</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if(!empty($riwayat)){ ?>
                    <?php $no=1; foreach($riwayat as $row){ ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $row['nama']; ?></td>

                            <td><?= $row['judul']; ?></td>

                            <td><?= $row['tanggalPeminjaman']; ?></td>

                            <td>
                                <?= !empty($row['tanggalPengembalian']) 
                                    ? $row['tanggalPengembalian'] 
                                    : '-' ?>
                            </td>

                            <td>
                                <?= !empty($row['tanggalJatuhTempo']) 
                                    ? $row['tanggalJatuhTempo'] 
                                    : '-' ?>
                            </td>

                            <td>

<?php

$tanggalPinjam = strtotime($row['tanggalPeminjaman']);

$jatuhTempo = !empty($row['tanggalJatuhTempo'])
    ? strtotime($row['tanggalJatuhTempo'])
    : strtotime('+7 days', $tanggalPinjam);

$tanggalAcuan = !empty($row['tanggalPengembalian'])
    ? strtotime($row['tanggalPengembalian'])
    : strtotime(date('Y-m-d'));

$telat = 0;

if($tanggalAcuan > $jatuhTempo){

    $telat = floor(
        ($tanggalAcuan - $jatuhTempo)
        / (60 * 60 * 24)
    );

}

$dendaTabel = $telat * 2000;

if($dendaTabel > 0){ ?>

    <span class="text-danger fw-bold">
        Rp <?= number_format($dendaTabel,0,',','.'); ?>
    </span>

<?php } else { ?>

    <span class="text-success">
        Rp 0
    </span>

<?php } ?>

</td>

                            <td>

                                <?php $status = $row['statusPeminjaman']; ?>

                                <?php if($status=='Proses'){ ?>

                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>

                                <?php } elseif($status=='Dipinjam'){ ?>

                                    <span class="badge bg-primary">
                                        Dipinjam
                                    </span>

                                <?php } elseif($status=='Pengembalian Diajukan'){ ?>

                                    <span class="badge bg-info text-dark">
                                        Pengembalian
                                    </span>

                                <?php } elseif($status=='Dikembalikan'){ ?>

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                <?php } elseif($status=='Ditolak'){ ?>

                                    <span class="badge bg-danger">
                                        Ditolak
                                    </span>

                                <?php } else { ?>

                                    <span class="badge bg-secondary">
                                        Dibatalkan
                                    </span>

                                <?php } ?>

                            </td>

                            <td>

                                <?php if($status=='Proses'){ ?>

                                    <a href="<?= base_url('admin/peminjaman/terima/'.$row['peminjamanID']) ?>"
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Terima pengajuan?')">

                                       Terima

                                    </a>

                                    <a href="<?= base_url('admin/peminjaman/tolak/'.$row['peminjamanID']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Tolak pengajuan?')">

                                       Tolak

                                    </a>

                                <?php } elseif($status=='Dipinjam'){ ?>

                                    <span class="text-muted">-</span>

                                <?php } elseif($status=='Pengembalian Diajukan'){ ?>

                                    <button type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalKembali<?= $row['peminjamanID'] ?>">

                                        Konfirmasi Kembali

                                    </button>

                                <?php } else { ?>

                                    <span class="text-muted">-</span>

                                <?php } ?>

                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="9" class="text-center">
                            Tidak ada data
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>
    </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Filter Laporan Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="get" action="<?= base_url('admin/laporan') ?>">

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="Proses">Proses</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Pengembalian Diajukan">Pengembalian Diajukan</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        Buat

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- 🔥 MODAL KONFIRMASI PENGEMBALIAN -->
<?php foreach($riwayat as $row){ ?>

<?php

$tanggalPinjam = strtotime($row['tanggalPeminjaman']);

$jatuhTempo = !empty($row['tanggalJatuhTempo'])
    ? strtotime($row['tanggalJatuhTempo'])
    : strtotime('+7 days', $tanggalPinjam);

$hariIni = strtotime(date('Y-m-d'));

$lamaPinjam = floor(($hariIni - $tanggalPinjam) / (60*60*24));

if($lamaPinjam < 0){
    $lamaPinjam = 0;
}

$telat = 0;

if($hariIni > $jatuhTempo){

    $telat = floor(($hariIni - $jatuhTempo) / (60*60*24));

}

$denda = $telat * 2000;

?>

<div class="modal"
     id="modalKembali<?= $row['peminjamanID'] ?>"
     tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Konfirmasi Pengembalian
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <strong>Nama Peminjam</strong><br>
                    <?= $row['nama']; ?>
                </div>

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

                    <?php if($telat > 0){ ?>

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

                    <strong>Denda Final</strong><br>

                    <?php if($denda > 0){ ?>

                        <span class="text-danger fw-bold">
                            Rp <?= number_format($denda,0,',','.'); ?>
                        </span>

                    <?php } else { ?>

                        <span class="text-success fw-bold">
                            Rp 0
                        </span>

                    <?php } ?>

                </div>

                <small class="text-muted">
                    Maksimal peminjaman 7 hari<br>
                    Denda keterlambatan Rp2.000 / hari
                </small>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">

                    Batal

                </button>

                <a href="<?= base_url('admin/peminjaman/kembalikan/'.$row['peminjamanID']) ?>"
                   class="btn btn-primary">

                    Konfirmasi Pengembalian

                </a>

            </div>

        </div>
    </div>
</div>

<?php } ?>
