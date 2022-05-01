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
                                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                </div>
                                <form class="user" method="post" action="/proses_login">
                                    <?= csrf_field(); ?>
                                    <!-- Username  -->
                                    <div class="form-group">
                                        <input type="text" name="username"
                                            class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>"
                                            id="validationServer03" placeholder="Masukan Username" autocomplete="off"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('username'); ?>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <input type="password" name="password"
                                            class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                            id="validationServer03" placeholder="Masukan Password" autocomplete="off"
                                            required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                            <input type="checkbox" name="remember_me" class="custom-control-input"
                                                id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"
                                            name="login">Login</button>
                                    </div>
                                </form>
                                <hr>
                                <?php if(session()->getFlashdata('salah_password')) { ?>
                                <?php session()->set(['lupa_password' => true]); ?>
                                <div class="text-center">
                                    <a class="font-weight-bold"
                                        href="/lupa_password/<?= session()->getFlashdata('salah_password') ?>">Lupa
                                        Password?</a>
                                </div>
                                <?php } ?>
                                <div class="text-center">
                                    Belum punya akun? <a class="font-weight-bold" href="/register">Register</a>
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