<?= $this->extend('layout/user_template'); ?>

<?= $this->section('content'); ?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catatan Saya</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">catatan</li>
        </ol>
    </div>

    <hr>

    <!-- alert berhasil tambah data -->
    <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success mt-3" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>

    <button class="btn btn-primary col-xl-12" onclick="buatCatatan()" id="btn-add"><i class="fas fa-sm fa-plus"></i>
        Buat Catatan
        Baru</button>

    <div class="row d-none" id="form-add">
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        Buat Catatan Baru<br>
                    </h6>
                </div>
                <div class="card-body text-right">
                    <form action="/catatan/buat_catatan" method="post">
                        <?= csrf_field(); ?>
                        <textarea name="catatan" class="form-control mb-2" rows="4"></textarea>
                        <button type="button" class="btn btn-light mr-2" onclick="buatCatatan()">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
    
    foreach($catatan as $catatan) :
        
        ?>
    <div class="row mb-3">

        <!-- Catatan -->
        <div class="col-xl-12 col-lg-4">
            <div class="card mb-2 mt-3">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nama : <?= $user['name']; ?><br>
                        Dibuat Pada : <?= $catatan['dibuat_pada']; ?>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <?= nl2br($catatan['content']); ?>
                </div>
                <hr>
                <div class="card-footer ml-auto">
                    <form action="/catatan/hapus/<?= $catatan['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger" onclick="return confirm('Hapus Catatan ini?');">hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    <hr>

    <?php endforeach; ?>

</div>
<!---Container Fluid-->

<script>
function buatCatatan() {
    const btn_add = document.getElementById('btn-add');
    const form_add = document.getElementById('form-add');

    btn_add.classList.toggle("d-none");
    form_add.classList.toggle("d-none");
}
</script>

<?= $this->endSection(); ?>