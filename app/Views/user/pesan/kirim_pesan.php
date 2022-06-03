<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kirim Pesan Untuk Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Pesan</li>
            <li class="breadcrumb-item active" aria-current="page">kirim pesan</li>
        </ol>
    </div>

    <hr>

    <!-- balasan kosong -->
    <div class="col-xl-10 col-lg-4 mb-5">
        <div class="card mb-3">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">
                    Ketikan Disini<br>
                </h6>
            </div>
            <div class="card-body text-right">
                <form action="/pesan/kirim" method="post">
                    <?= csrf_field(); ?>
                    <textarea name="message"
                        class="form-control <?= ($validation->hasError('message')) ? 'is-invalid' : ''; ?> mb-2"
                        rows="5"></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('message'); ?>
                    </div>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <!-- balasan kosong -->
</div>
<!--Row-->

<hr>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>