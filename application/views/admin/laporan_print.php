<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="p-4">

    <?php
    $dari = $this->input->get('dari');
    $sampai = $this->input->get('sampai');
    ?>

    <div class="text-center mb-3">
        <h4>Laporan Riwayat Peminjaman</h4>
        <p>
            <?= $dari ? $dari : '-' ?> s.d <?= $sampai ? $sampai : '-' ?>
        </p>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Judul</th>
                <th>Pinjam</th>
                <th>Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;
            foreach ($laporan as $row) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['judul']; ?></td>
                    <td><?= $row['tanggalPeminjaman']; ?></td>
                    <td><?= $row['tanggalPengembalian'] ?? '-' ?></td>
                    <td><?= $row['statusPeminjaman']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-end gap-2 mt-3 no-print">

        <a href="<?= base_url('admin/peminjaman') ?>" class="btn btn-outline-secondary">
            Kembali
        </a>

        <button onclick="window.print()" class="btn btn-dark">
            Cetak
        </button>

    </div>

</body>

</html><!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
    <style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
    </style>    
</head>

<body class="p-4">

<?php
$dari = $this->input->get('dari');
$sampai = $this->input->get('sampai');
?>

<div class="text-center mb-3">
    <h4>Laporan Riwayat Peminjaman</h4>
    <p>
        <?= $dari ? $dari : '-' ?> s.d <?= $sampai ? $sampai : '-' ?>
    </p>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Judul</th>
            <th>Pinjam</th>
            <th>Kembali</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; foreach($laporan as $row){ ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['tanggalPeminjaman']; ?></td>
            <td><?= $row['tanggalPengembalian'] ?? '-' ?></td>
            <td><?= $row['statusPeminjaman']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="d-flex justify-content-end gap-2 mt-3 no-print">

    <!-- 🔙 BATAL -->
    <a href="<?= base_url('admin/peminjaman') ?>"
       class="btn btn-outline-secondary">
        Kembali
    </a>

    <!-- 🖨 CETAK -->
    <button onclick="window.print()" class="btn btn-dark">
        Cetak
    </button>

</div>

</body>
</html>
