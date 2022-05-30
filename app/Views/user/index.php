<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">index</li>
        </ol>
    </div>

    <div class="row mb-3">

        <!-- Hello -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat datang <?= $user['name']; ?>, di aplikasi
                        MyTask!</h6>
                </div>
                <div class="card-body">
                    Aplikasi ini dibuat untuk menyimpan tugas, catatan, impian, tujuan, dan apa saja bebas yang ingin
                    kamu tulis dan simpan disini.
                </div>
            </div>
        </div>
        <!-- Hello -->

        <!-- Pesan Dari User -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Semua Task</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($task); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Terdaftar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Task Berjalan</div>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= count($task_berjalan); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-history fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Task Semua User -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Task Diselesaikan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="text-success"><?= count($task_selesai); ?></span>
                                +
                                <span class="text-danger"><?= count($task_gagal); ?></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pesan Dari User -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Catatan Dibuat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($catatan); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--Row-->

    <div class="home-plus"></div>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>