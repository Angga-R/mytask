<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesan Untuk Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">pesan untuk admin</li>
        </ol>
    </div>

    <hr>

    <?php 
    
        foreach($adminMessage as $pesan) :

    ?>
    <div class="row mb-3">

        <!-- Pesan -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-2 mt-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nama Pengirim : <?= $pesan['nama_user']; ?><br>
                        Dibuat Pada : <?= $pesan['created_at']; ?>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <?= nl2br($pesan['message']); ?>
                </div>
            </div>

        </div>
        <!-- Pesan -->
        <?php if($pesan['balasan'] != null) { ?>
        <!-- Balasan Terisi -->
        <div class="col-xl-10 col-lg-4 ml-auto">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        Balasan Dari Admin
                    </h6>
                </div>
                <div class="card-body">
                    <?= nl2br($pesan['balasan']); ?>
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
                        Balas Sebagai Admin<br>
                    </h6>
                </div>
                <div class="card-body text-right">
                    <form action="/admin/kirim_balasan/<?= $pesan['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <textarea name="balasan"
                            class="form-control <?= ($validation->hasError('balasan')) ? 'is-invalid' : ''; ?> mb-2"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('balasan'); ?>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
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