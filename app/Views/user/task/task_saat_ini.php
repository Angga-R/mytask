<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Task Saat Ini</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Task</li>
            <li class="breadcrumb-item active" aria-current="page">task saat ini</li>
        </ol>
    </div>

    <hr class="mb-4">

    <!-- alert berhasil tambah data -->
    <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>

    <div class="row mb-5">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-4">
            <?php if(count($task_berjalan) > 0) { ?>
            <?php foreach($task_berjalan as $task_berjalan) : ?>
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $task_berjalan['content']; ?></h6>
                    <div>
                        <form action="/task/task_selesai/<?= $task_berjalan['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-success">Y</button>
                        </form>
                        <form action="/task/task_gagal/<?= $task_berjalan['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">X</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php }else{ ?>
            <h1 class="h3 mb-4 mt-4 text-gray-500 text-center">Task Anda Kosong</h1>
            <?php } ?>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

    <hr>

    <div class="home-plus" id="task-plus"></div>
    <div class="home-plus"></div>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>