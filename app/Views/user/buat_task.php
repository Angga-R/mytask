<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Task Baru</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Task</li>
            <li class="breadcrumb-item active" aria-current="page">buat task baru</li>
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
            <form action="/task/buat_task" method="post">
                <?= csrf_field(); ?>
                <div class="input-group">
                    <input type="text" name="content"
                        class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : ''; ?>"
                        placeholder="Masukan Disini.." autocomplete="off" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">+</button>
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('content'); ?>
                    </div>
                </div>
            </form>
        </div>
        <!-- Pie Chart -->

    </div>
    <!--Row-->

    <hr class="mb-5">

    <div class="home-plus"></div>
    <div class="home-plus"></div>
    <div class="home-plus" id="task-plus"></div>

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>