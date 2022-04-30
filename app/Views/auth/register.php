<?= $this->extend('layout/log_template'); ?>

<?= $this->section('content'); ?>

<div class="container-login">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card shadow-sm my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="login-form">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                </div>
                                <form class="user" method="post" action="/proses_register">
                                    <?= csrf_field(); ?>
                                    <!-- Username -->
                                    <div class="form-group">
                                        <label>Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">@</span>
                                            </div>
                                            <input type="text" name="username"
                                                class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                                                id="validationServer03" placeholder="Buat Username Anda"
                                                autocomplete="off" required>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('username'); ?>
                                            </div>
                                        </div>
                                        <small>tanda '@' otomatis ditambahkan</small>
                                    </div>

                                    <!-- Name -->
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name"
                                            class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                                            id="validationServer03" placeholder="Masukan Nama Anda" autocomplete="off"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name'); ?>
                                        </div>
                                    </div>

                                    <!-- Gender -->
                                    <div class="form-group">
                                        <label class="d-flex">Jenis Kelamin</label>
                                        <div class="custom-control custom-radio d-inline">
                                            <input type="radio" id="customRadio3" name="gender"
                                                class="custom-control-input" value="Laki-laki" />
                                            <label class="custom-control-label" for="customRadio3">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio d-inline ml-2">
                                            <input type="radio" id="customRadio4" name="gender"
                                                class="custom-control-input" value="Perempuan" />
                                            <label class="custom-control-label" for="customRadio4">Perempuan</label>
                                        </div>
                                        <?php if($validation->hasError('gender')) { ?>
                                        <div class="text-danger mt-1 border-top border-danger">
                                            <?= $validation->getError('gender'); ?>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                            id="validationServer03" placeholder="Buat Password Anda" autocomplete="off"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <label>Ulangi Password</label>
                                        <input type="password" name="repeat_password"
                                            class="form-control <?= ($validation->hasError('repeat_password')) ? 'is-invalid' : ''; ?>"
                                            id="validationServer03" placeholder="Masukan Password Kembali"
                                            autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('repeat_password'); ?>
                                        </div>
                                    </div>

                                    <!-- Pertanyaan Keamanan -->
                                    <div class="form-group">
                                        <label>Pertanyaan Keamanan</label>
                                        <select name="pertanyaan_keamanan" class="custom-select" required>
                                            <option value="" hidden>Pilih Pertanyaan</option>
                                            <option value="Nama guru favorit">Nama guru favorit saya</option>
                                            <option value="Nama ayah">Nama ayah saya</option>
                                            <option value="Nama ibu">Nama ibu saya</option>
                                            <option value="Nama orang tersayang">Nama orang tersayang saya</option>
                                            <option value="Makanan favorit">Makanan favorit saya</option>
                                            <option value="Minuman favorit">Minuman favorit saya</option>
                                            <option value="Cita-cita">Cita-cita saya</option>
                                        </select>
                                        <input type="text" name="jawaban_keamanan"
                                            class="form-control <?= ($validation->hasError('jawaban_keamanan')) ? 'is-invalid' : ''; ?> mt-2"
                                            placeholder="Jawaban pertanyaan" autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jawaban_keamanan'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"
                                            name="login">Daftar</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    Sudah Memiliki akun? <a class="font-weight-bold" href="/login">Login</a>
                                </div>
                                <div class="text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>