<?= $this->session->flashdata('notifikasi', TRUE); ?>

<div class="card p-3">

    <!-- FOTO -->
    <div class="text-center mb-3">
        <?php if(!empty($user->foto)){ ?>
            <img src="<?= base_url('sneat/assets/upload/user/'.$user->foto) ?>" 
                 width="300" height="300"
                 style="border-radius:50%; object-fit:cover;">
        <?php }else{ ?>
            <img src="<?= base_url('sneat/assets/img/avatars/13.png') ?>" 
                 width="300" height="300"
                 style="border-radius:50%; object-fit:cover;">
        <?php } ?>
    </div>

    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="userID" value="<?= $user->userID; ?>">
        <input type="hidden" name="foto_lama" value="<?= $user->foto; ?>">

        <!-- 🔥 IMPORTANT: username harus ikut terkirim -->
        <div class="mb-2">
            <label>Username</label>
            <input type="text" name="username" class="form-control" 
                   value="<?= $user->username ?>" readonly>
        </div>

        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" 
                   value="<?= $user->nama ?>">
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" 
                   value="<?= $user->email ?>">
        </div>

        <div class="mb-2">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" 
                value="<?= $user->no_hp ?>">
        </div>

        <div class="mb-2">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $user->alamat ?></textarea>
        </div>

        <div class="mb-3">
            <label>Foto Baru</label>
            <input type="file" name="foto" class="form-control">
        </div>
        
        <!-- <div class="d-flex gap-2 mt-3">
            <a href="<?= base_url('home') ?>" class="btn btn-outline-secondary w-50">
                Batal
            </a>
            <button type="submit" class="btn btn-primary w-50">Simpan</button>
        </div> -->
        <div class="d-flex justify-content-between mt-3">
            <a href="<?= base_url('profile/kartu') ?>" class="btn btn-success">
        Kartu Anggota
    </a>
    <div class="d-flex gap-2">
            <a href="<?= base_url('home') ?>" class="btn btn-outline-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary ">Simpan</button>
            </div>
        </div>
        <!-- <button class="btn btn-primary w-100">Simpan</button> -->
    </form>
</div>