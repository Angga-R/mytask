<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Profil Saya
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">profil</li>
        </ol>
    </div>

    <div class="row mb-3">

        <!-- alert berhasil ubah data -->
        <div class="col-xl-12 col-lg-4">
            <?php if (session()->getFlashdata('pesan')) { ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php } elseif($validation->hasError('foto') || $validation->hasError('name') || $validation->hasError('username') || $validation->hasError('password') || $validation->hasError('jawaban_keamanan')) { ?>
            <?php $validasi = $validation->getErrors(['foto', 'name', 'username', 'jawaban_keamanan', 'password']); ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php foreach($validasi as $v) { echo $v; } ?>
            </div>
            <?php } ?>
            <div class="card mb-4">
                <!-- Foto -->
                <div class="card-header py-3 d-block">
                    <div class="container mx-auto text-center">
                        <img src="img/user/<?= $user['foto'] ?>" class="rounded-circle" width="250" height="250"
                            id="foto">
                    </div>
                    <center class="mt-2 text-info d-none" id="info">*ini bukan preview asli, ukuran gambar akan otomatis
                        di potong bagian tengah
                        oleh
                        sistem
                        (250x250)
                    </center>
                    <div class="container text-center mt-3 d-none" id="ganti-foto">
                        <form action="/profil/ganti_foto" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="gender" value="<?= $user['gender']; ?>">
                            <input type="hidden" name="foto_lama" value="<?= $user['foto']; ?>">
                            <input type="file" name="foto" class="form-control" id="choose-file"
                                onchange="previewImg()">
                            <button type="submit" class="btn btn-success btn-sm mt-2">Ganti Foto</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Username -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-username">Username : </label>
                            <input type="text" value="<?= $user['username']; ?>" class="form-control" id="username"
                                readonly>
                            <span class="btn ml-2" id="btn-username"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_username" method="post" class="d-none" id="form-username">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-username-2">Username : </label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="hidden" name="username_lama" value="<?= $user['username']; ?>">
                                <input type="text" class="form-control" name="username"
                                    value="<?= substr($user['username'], 1); ?>" autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-username">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Nama -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-nama">Nama : </label>
                            <input type="text" value="<?= $user['name']; ?>" class="form-control" id="nama" readonly>
                            <span class="btn ml-2" id="btn-nama"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_nama" method="post" class="d-none" id="form-nama">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-nama-2">Nama : </label>
                                <input type="hidden" name="name_lama" value="<?= $user['name']; ?>">
                                <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>"
                                    autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-nama">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Gender -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-gender">Gender : </label>
                            <input type="text" value="<?= $user['gender']; ?>" class="form-control" id="gender"
                                readonly>
                            <span class="btn ml-2" id="btn-gender"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_gender" method="post" class="d-none" id="form-gender">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-gender-2">Gender : </label>
                                <select name="gender" class="custom-select" required>
                                    <option value="<?= $user['gender']; ?>" hidden>
                                        <?= $user['gender']; ?></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <button type="submit" class="btn ml-2 btn-success"><span class="fa fa-edit"></button>
                                <span class="btn ml-2 d-none close" id="btn-close-gender">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Pertanyaan Keamanan -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-pertanyaan">Pertanyaan Keamanan : </label>
                            <input type="text" value="<?= $user['pertanyaan_keamanan']; ?>" class="form-control"
                                id="pertanyaan" readonly>
                            <span class="btn ml-2" id="btn-pertanyaan"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_pertanyaan_keamanan" method="post" class="d-none"
                            id="form-pertanyaan">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-pertanyaan-2">Pertanyaan Keamanan : </label>
                                <select name="pertanyaan_keamanan" class="custom-select" required>
                                    <option value="<?= $user['pertanyaan_keamanan']; ?>" hidden>
                                        <?= $user['pertanyaan_keamanan']; ?></option>
                                    <option value="Nama guru favorit">Nama guru favorit saya</option>
                                    <option value="Nama ayah">Nama ayah saya</option>
                                    <option value="Nama ibu">Nama ibu saya</option>
                                    <option value="Nama orang tersayang">Nama orang tersayang saya</option>
                                    <option value="Makanan favorit">Makanan favorit saya</option>
                                    <option value="Minuman favorit">Minuman favorit saya</option>
                                    <option value="Cita-cita">Cita-cita saya</option>
                                </select>
                                <button type="submit" class="btn ml-2 btn-success"><span class="fa fa-edit"></button>
                                <span class="btn ml-2 d-none close" id="btn-close-pertanyaan">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Jawaban Keamanan -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-jawaban">Jawaban Keamanan : </label>
                            <input type="text" value="Bersifat Rahasia" class="form-control text-danger" id="jawaban"
                                readonly>
                            <span class="btn ml-2" id="btn-jawaban"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_jawaban_keamanan" method="post" class="d-none" id="form-jawaban">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-jawaban-2">Jawaban Keamanan : </label>
                                <input type="password" class="form-control" name="jawaban_keamanan" autocomplete="off"
                                    required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-jawaban">x</span>
                            </div>
                        </form>
                    </div>
                    <!-- Ganti Password -->
                    <div class="card py-2 px-2 border border-secondary mb-2">
                        <div class="input-group">
                            <label class="col-form-label mr-2" id="lb-password">Password : </label>
                            <input type="text" value="Bersifat Rahasia" class="form-control text-danger" id="password"
                                readonly>
                            <span class="btn ml-2" id="btn-password"><span class="fa fa-edit"></span></span>
                        </div>
                        <form action="/profil/ganti_password_user" method="post" class="d-none" id="form-password">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <label class="col-form-label mr-2" id="lb-password">Password : </label>
                                <input type="password" class="form-control" name="password" autocomplete="off" required>
                                <button type="submit" class="btn" hidden></button>
                                <span class="btn ml-2 d-none close" id="btn-close-password">x</span>
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
<script src="<?= base_url(); ?>/js/script-user.js"></script>

<?= $this->endSection(); ?>