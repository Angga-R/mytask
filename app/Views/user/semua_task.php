<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Semua Task</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item">Task</li>
            <li class="breadcrumb-item active" aria-current="page">semua task</li>
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
                        placeholder="Buat Task Baru" autocomplete="off" required>
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

    <hr class="mb-4">

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
            <h1 class="h3 mb-0 text-gray-500 text-center">Task Anda Kosong</h1>
            <?php } ?>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

    <hr>

    <h1 class="h3 mb-0 text-gray-800">Riwayat Task</h1>

    <div class="row mt-5 mb-5">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <table class="table align-items-center text-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Isi Task</th>
                                <th>Dimulai Pada</th>
                                <th>Selesai Pada</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Isi Task</th>
                                <th>Dimulai Pada</th>
                                <th>Selesai Pada</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($task_selesai as $task_selesai) : 
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $task_selesai['content']; ?></td>
                                <td><?= substr($task_selesai['start'], 0, 16); ?></td>
                                <td><?= substr($task_selesai['end'], 0, 16); ?></td>
                                <td><span
                                        class="<?= ($task_selesai['status'] == 'selesai') ? 'text-success'  : 'text-danger' ?>"><?= $task_selesai['status']; ?></span>
                                </td>
                                <td>
                                    <form action="/task/hapus/<?= $task_selesai['id']; ?>" method="post"
                                        class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-md"
                                            onclick="return confirm('Apakah data ini akan dihapus?');"><span
                                                class="fa fa-trash"></span></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php foreach($task_gagal as $task_gagal) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $task_gagal['content']; ?></td>
                                <td><?= substr($task_gagal['start'], 0, 16); ?></td>
                                <td><?= substr($task_gagal['end'], 0, 16); ?></td>
                                <td><span
                                        class="<?= ($task_gagal['status'] == 'selesai') ? 'text-success'  : 'text-danger' ?>"><?= $task_gagal['status']; ?></span>
                                </td>
                                <td>
                                    <form action="/task/hapus/<?= $task_gagal['id']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-md"
                                            onclick="return confirm('Apakah data ini akan dihapus?');"><span
                                                class="fa fa-trash"></span></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>