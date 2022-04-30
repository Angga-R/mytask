<?= $this->extend('layout/log_template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <!-- Pertanyaan Keamanan -->
        <div class="card shadow-sm my-5">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Pertanyaan Keamanan
                </h6>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('jawaban_benar')) { ?>
                <form action="/ubah_password" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password"
                                class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                autocomplete="off" name="password" required />
                            <input type="hidden" value="<?= $user['id']; ?>" name="id">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                Ganti
                            </button>
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                <form action="/cek_pertanyaan_keamanan" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="inputEmail3"
                            class="col-sm-3 col-form-label"><?= $user['pertanyaan_keamanan']; ?></label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control <?= ($validation->hasError('jawaban')) ? 'is-invalid' : ''; ?>"
                                autocomplete="off" name="jawaban" required />
                            <input type="hidden" value="<?= $user['jawaban_keamanan']; ?>" name="jawaban_asli">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jawaban'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>