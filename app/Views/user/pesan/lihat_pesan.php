<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item">Pesan</li>
            <li class="breadcrumb-item active" aria-current="page">lihat pesan</li>
        </ol>
    </div>

    <hr>

    <div class="row mb-3">

        <!-- Pesan -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-2 mt-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nama Pengirim : <?= $this_message['nama_user']; ?><br>
                        Dibuat Pada : <?= $this_message['created_at']; ?>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <?= nl2br($this_message['message']); ?>
                </div>
            </div>

        </div>
        <!-- Pesan -->
        <!-- Balasan Terisi -->
        <div class="col-xl-10 col-lg-4 ml-auto">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        Balasan Dari Admin
                    </h6>
                </div>
                <div class="card-body">
                    <?= nl2br($this_message['balasan']); ?>
                </div>
            </div>
        </div>
        <!-- Balasan Terisi -->
    </div>
    <!--Row-->

    <hr>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>