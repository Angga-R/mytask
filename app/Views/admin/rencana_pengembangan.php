<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rencana Pengembangan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">rencana pengembangan</li>
        </ol>
    </div>

    <div class="row mb-3">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-4">
            <!-- alert berhasil tambah data -->
            <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success mt-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php endif; ?>
            <form action="/tambah_rencana" method="post">
                <?= csrf_field(); ?>
                <div class="input-group">
                    <input type="text" name="isi_rencana"
                        class="form-control <?= ($validation->hasError('isi_rencana')) ? 'is-invalid' : ''; ?>"
                        placeholder="Tambah Rencana Pengembangan" autocomplete="off" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">+</button>
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_rencana'); ?>
                    </div>
                </div>
            </form>
        </div>
        <!-- Pie Chart -->

    </div>
    <!--Row-->

    <hr class="mb-4">

    <div class="row mb-5">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-4">
            <?php if(count($rencana) > 0) { ?>
            <?php foreach($rencana as $rencana) : ?>
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $rencana['isi_rencana']; ?></h6>
                    <div>
                        <form action="/rencana_selesai/<?= $rencana['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-success">Y</button>
                        </form>
                        <form action="/rencana_gagal/<?= $rencana['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php }else{ ?>
            <h1 class="h3 mb-0 text-gray-500 text-center">Data Tidak Tersedia</h1>
            <?php } ?>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

    <hr>

    <h1 class="h3 mb-0 text-gray-800">Riwayat Pengembangan</h1>

    <div class="row mt-5">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-4">
            <?php if(count($rencana_end) > 0) { ?>
            <?php foreach($rencana_end as $rencana_end) : ?>
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6
                        class="m-0 font-weight-bold <?= ($rencana_end['status'] == 'selesai') ? 'text-success' : 'text-danger'; ?>">
                        <?= $rencana_end['isi_rencana']; ?>
                        (<?= $rencana_end['status']; ?>)(<?= $rencana_end['tgl_selesai']; ?>)</h6>
                </div>
            </div>
            <?php endforeach; ?>
            <?php }else{ ?>
            <h1 class="h3 mb-0 text-gray-500 text-center">Data Tidak Tersedia</h1>
            <?php } ?>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>