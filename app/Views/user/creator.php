<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Creator MyTask
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">creator</li>
        </ol>
    </div>

    <div class="row mb-3">

        <!-- alert berhasil ubah data -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-4">
                <!-- Foto -->
                <div class="card-header py-3 d-block">
                    <div class="container mx-auto text-center">
                        <img src="img/admin/<?= $creator['foto'] ?>" class="rounded-circle" width="250" height="250"
                            id="foto">
                    </div>
                    <div class="container text-center mt-3">
                        <span class="h4"><b><?= $creator['nama']; ?></b></span><br>
                        <span><i><?= $creator['email']; ?></i></span>
                    </div>
                </div>
                <div class="card-body text-center mt-3">
                    <b><u>Tentang Saya :</u></b> <br>
                    <?= nl2br($creator['tentang']); ?>
                </div>
                <div class="card-footer text-center">
                    <span>Kunjungi Portfolio saya di : <a
                            href="<?= $creator['link_portfolio']; ?>"><?= $creator['link_portfolio']; ?></a></span>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>