<?= $this->session->flashdata('notifikasi', TRUE); ?>

<!-- 🔘 BUTTON MODAL -->
<!-- <div class="mb-3">
    <button type="button" class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalLaporan">
        Laporan Peminjaman
    </button>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Filter Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="get" action="<?= base_url('admin/laporan') ?>">

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="dari" class="form-control" required
                               value="<?= $this->input->get('dari'); ?>">
                    </div>

                    <div class="mb-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="sampai" class="form-control" required
                               value="<?= $this->input->get('sampai'); ?>">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="Proses">Proses</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Pengembalian Diajukan">Pengembalian</option>
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
                        Tampilkan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div> -->

<!-- 📊 CARD TABEL -->
<div class="card">
    <h5 class="card-header">Data Laporan Peminjaman</h5>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($laporan)){ ?>
                    <?php $no=1; foreach($laporan as $row){ ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['tanggalPeminjaman']; ?></td>
                            <td><?= !empty($row['tanggalPengembalian']) ? $row['tanggalPengembalian'] : '-' ?></td>
                            <td>
                                <?php
                                $s = $row['statusPeminjaman'];
                                if($s=='Proses') echo '<span class="badge bg-warning text-dark">Proses</span>';
                                elseif($s=='Dipinjam') echo '<span class="badge bg-primary">Dipinjam</span>';
                                elseif($s=='Pengembalian Diajukan') echo '<span class="badge bg-info text-dark">Pengembalian</span>';
                                elseif($s=='Dikembalikan') echo '<span class="badge bg-success">Selesai</span>';
                                elseif($s=='Ditolak') echo '<span class="badge bg-danger">Ditolak</span>';
                                else echo '<span class="badge bg-secondary">Dibatalkan</span>';
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Silakan filter laporan terlebih dahulu
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div class="modal-footer mt-3 d-flex justify-content-end gap-2">

        <!-- 🔙 BATAL -->
        <a href="<?= base_url('admin/peminjaman') ?>"
        class="btn btn-outline-secondary">
            Batal
        </a>

        <!-- 🖨 CETAK -->
        <a href="<?= base_url('admin/laporan/print?dari='
            .$this->input->get('dari')
            .'&sampai='
            .$this->input->get('sampai')
            .'&status='
            .$this->input->get('status')) ?>"
        target="_blank"
        class="btn btn-primary">
            Cetak
        </a>

    </div>
</div>
