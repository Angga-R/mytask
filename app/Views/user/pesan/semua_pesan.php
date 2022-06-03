<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Semua Pesan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item">Pesan</li>
            <li class="breadcrumb-item active" aria-current="page">semua pesan</li>
        </ol>
    </div>

    <hr>
    <!-- alert berhasil tambah data -->
    <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>

    <?php 
    
        foreach($all_message as $message) :

    ?>
    <div class="row mb-3">

        <!-- Pesan -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-2 mt-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nama Pengirim : <?= $message['nama_user']; ?><br>
                        Dibuat Pada : <?= $message['created_at']; ?>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <?= nl2br($message['message']); ?>
                </div>
            </div>

        </div>
        <!-- Pesan -->
        <?php if($message['balasan'] != null) { ?>
        <!-- Balasan Terisi -->
        <div class="col-xl-10 col-lg-4 ml-auto">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        Balasan Dari Admin
                    </h6>
                </div>
                <div class="card-body">
                    <?= nl2br($message['balasan']); ?>
                </div>
            </div>
        </div>
        <!-- Balasan Terisi -->
        <?php }else{ ?>
        <!-- balasan kosong -->
        <div class="col-xl-10 col-lg-4 ml-auto">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-warning">
                    <h6 class="m-0 font-weight-bold text-white">
                        Balasan Dari Admin<br>
                    </h6>
                </div>
                <div class="card-body">
                    Admin Belum Membalas
                </div>
            </div>
        </div>
        <!-- balasan kosong -->
        <?php } ?>
    </div>
    <!--Row-->

    <hr>

    <?php endforeach; ?>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>