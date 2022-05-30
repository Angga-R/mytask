<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Data Admin
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page" id="1">data admin</li>
        </ol>
    </div>

    <div class="row mb-3">

        <!-- alert berhasil tambah data -->

        <div class="col-xl-12 col-lg-4">
            <?php if (session()->getFlashdata('pesan')) { ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php } elseif($validation->hasError('foto') || $validation->hasError('nama') || $validation->hasError('email') || $validation->hasError('link') || $validation->hasError('tentang') || $validation->hasError('password')) { ?>
            <?php $validasi = $validation->getErrors(['foto', 'nama', 'email', 'link', 'tentang', 'password']); ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php foreach($validasi as $v) { echo $v; } ?>
            </div>
            <?php } ?>
            <div class="card mb-4">
                <!-- Foto -->
                <div class="card-header py-3 d-block">
                    <div class="container mx-auto text-center">
                        <img src="img/admin/<?= $data_admin['foto'] ?>" class="rounded-circle" width="250" height="250"
                            id="foto">
                    </div>
                    <center class="mt-2 text-info d-none" id="info">*ini bukan preview asli, ukuran gambar akan otomatis
                        di potong bagian tengah
                        oleh
                        sistem
                        (250x250)
                    </center>
                    <div class="container text-center mt-3 d-none" id="ganti-foto">
                        <form action="/ganti_foto_admin" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="file" name="foto" class="form-control" id="choose-file"
                                onchange="previewImg()">
                            <button type="submit" class="btn btn-success btn-sm mt-2">Ganti Foto</button>
                        </form>
                    </div>
                </div>
                <!-- Nama -->
                <div class="card-body">
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-nama">Nama : </label>
                            <input type="text" value="<?= $data_admin['nama']; ?>" class="form-control" id="nama"
                                readonly>
                            <span class="btn ml-2" id="btn-nama"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/ganti_nama_admin" method="post" class="d-none" id="form-nama">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-nama-2">Nama : </label>
                                <input type="text" class="form-control" name="nama" value="<?= $data_admin['nama']; ?>"
                                    autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-nama">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Email -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-email">Email : </label>
                            <input type="text" value="<?= $data_admin['email']; ?>" class="form-control" id="email"
                                readonly>
                            <span class="btn ml-2" id="btn-email"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/ganti_email_admin" method="post" class="d-none" id="form-email">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-email-2">Email : </label>
                                <input type="email" class="form-control" name="email"
                                    value="<?= $data_admin['email']; ?>" autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-email">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Link Portfolio -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-link">Link Portfolio : </label>
                            <input type="text" value="<?= $data_admin['link_portfolio']; ?>" class="form-control"
                                id="link" readonly>
                            <span class="btn ml-2" id="btn-link"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="ganti_link_admin" method="post" class="d-none" id="form-link">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-link-2">Link Portfolio : </label>
                                <input type="text" class="form-control" name="link"
                                    value="<?= $data_admin['link_portfolio']; ?>" autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-link">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Tentang -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-tentang">Tentang : </label>
                            <div class="card-body" id="tentang">
                                <?= nl2br($data_admin['tentang']); ?>
                            </div>
                            <span class="btn ml-2" id="btn-tentang"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/ganti_tentang_admin" method="post" class="d-none" id="form-tentang">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-tentang-2">Tentang : </label>
                                <textarea class="form-control" rows="5" name="tentang" autocomplete="off" required>
                                    <?= $data_admin['tentang']; ?>
                                </textarea>
                                <button type="submit" class="btn btn-success mt-1">Save</button>
                                <span class="btn ml-2 d-none close" id="btn-close-tentang">x</span>
                            </div>
                        </form>
                    </div>
                    <span class="card text-center d-none" id="2">?</span>
                    <!-- Ganti Password -->
                    <div class="card py-2 px-2 border border-secondary mb-2 d-none" id="ganti-password">
                        <form action="ganti_password_admin" method="post">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2">Password : </label>
                                <input type="password" class="form-control" name="password" autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 close" id="btn-close-password">x</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->
<script src="js/script-admin.js"></script>

<?= $this->endSection(); ?>