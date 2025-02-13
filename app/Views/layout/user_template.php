<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url(); ?>/img/logo/mytask-logo.png" rel="icon">
    <title><?= $title; ?></title>
    <link href="<?= base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>/css/ruang-admin.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- TopBar -->
    <nav class="navbar navbar-expand navbar-light topbar static-top" id="nav-top-user">
        <a href="/"><span class="ml-2"><img src="<?= base_url(); ?>/img/logo/MyTask.svg"></span></a>
    </nav>
    <!-- Topbar -->

    <div id="wrapper mb-5">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <a href="/"><span class="ml-2" id="logo-mytask-bot"><img
                                src="<?= base_url(); ?>/img/logo/MyTask.svg"></span></a>
                    <ul class="navbar-nav" id="ul-bot-user">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-warning badge-counter"><?= count($message); ?></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Pesan Admin
                                </h6>
                                <a class="dropdown-item text-center small" href="/pesan_admin/kirim_pesan">
                                    + Kirim Pesan Baru</a>
                                <?php foreach($message as $m) : ?>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="/pesan_admin/lihat_pesan/<?= $m['id'] ?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="<?= base_url(); ?>/img/user/<?= $user['foto']; ?>"
                                            style="max-width: 60px" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?= $m['message']; ?></div>
                                        <div class="small text-gray-500">Klik untuk melihat balasan admin</div>
                                    </div>
                                </a>
                                <?php endforeach; ?>
                                <?php if(count($all_message) > 0) : ?>
                                <a class="dropdown-item text-center small text-gray-500" href="/pesan_admin ">Lihat
                                    Semua Pesan (<?= count($all_message); ?>)</a>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-tasks fa-fw"></i>
                                <span class="badge badge-success badge-counter"><?= count($task); ?></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Task
                                </h6>
                                <a class="dropdown-item text-center small" href="/task/buat_task">
                                    + Buat Task Baru</a>
                                <a class="dropdown-item align-items-center" href="/task/task_saat_ini">
                                    <i class="fas fa-clock text-warning"></i> Task Saat Ini
                                    <span class="bg-warning text-white px-1 ml-2"><?= count($task_berjalan); ?></span>
                                </a>
                                <a class="dropdown-item align-items-center" href="/task/riwayat_task">
                                    <i class="fas fa-history text-success"></i> Riwayat Task
                                    <span
                                        class="bg-success text-white px-1 ml-2"><?= $riwayat = count($task_selesai) + count($task_gagal); ?></span>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="/task/semua_task">Lihat
                                    Semua
                                    Task</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link" href="/catatan">
                                <i class="fas fa-calendar"></i>
                            </a>
                        </li>
                        <div class="topbar-divider d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url(); ?>/img/user/<?= $user['foto']; ?>" style="max-width: 60px">
                                <span
                                    class="ml-2 d-lg-inline text-white small"><?= substr($user['name'], 0, 7); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" onclick="return confirm('Anda akan logout?');" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->
                <?= $this->renderSection('content'); ?>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-4 bg-dark text-white text-center">
        <p>Created by <a href="/creator" class="text-white fw-bold">Anggara</a>
        </p>
    </footer>


    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="<?= base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url(); ?>/js/ruang-admin.min.js"></script>

    <?php if(isset($datatable)) { ?>
    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
    $(document).ready(function() {
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
    </script>
    <?php } ?>

</body>

</html>