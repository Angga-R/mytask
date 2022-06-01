<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">data user</li>
        </ol>
    </div>

    <hr>

    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                    <?php endif; ?>
                    <table class="table align-items-center text-center table-flush table-hover" id="dataTableHover">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Jenis Kelamin</th>
                                <th>Daftar Pada</th>
                                <th>Jumlah Task Dibuat</th>
                                <th>Jumlah Catatan Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Jenis Kelamin</th>
                                <th>Daftar Pada</th>
                                <th>Jumlah Task Dibuat</th>
                                <th>Jumlah Catatan Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($user as $user) : 
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['name']; ?></td>
                                <td><?= $user['gender']; ?></td>
                                <td><?= $user['created_at']; ?></td>
                                <td><?= count($task->where('user', $user['username'])->findAll()); ?></td>
                                <td><?= count($catatan->where('user', $user['username'])->findAll()); ?></td>
                                <td>
                                    <form action="/hapus_user/<?= $user['id']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-md"
                                            onclick="return confirm('Apakah user dengan nama <?= $user['name']; ?> ini akan dihapus?');"><span
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
    </div>
    <!--Row-->

</div>
<!---Container Fluid-->

<?= $this->endSection(); ?>