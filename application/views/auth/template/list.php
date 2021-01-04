<?php



if ($this->session->userdata('email') == '') {

    redirect(base_url('auth/login'), 'refresh');
}
$auth_menu = $this->auth_menu_model->list();
$active = '';
$session = $this->auth_user_model->get($this->session->userdata('email'));

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/sbadmin2/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/sbadmin2/') ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/sbadmin2/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.js"></script>
    <script src="//cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-sun"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Fellie</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <?php
            foreach ($auth_menu as $menu) {

            ?>
                <li class="nav-item <?php if ($menu->nama == $title) {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?= base_url($menu->link) ?>">
                        <i class="fas fa-fw fa-<?= $menu->icon ?>"></i>
                        <span><?= $menu->nama ?></span></a>
                </li>
            <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $session->nama ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/img/auth/foto/thumb/cropped/'.$session->foto) ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" id="logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <?php
                    if ($content) {
                        $this->load->view($content);
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="isiModal">
                ...
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/sbadmin2/') ?>js/sb-admin-2.min.js"></script>
    <script>
        const base_url = '<?= base_url('/') ?>'

        $('a#logout').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Anda akan logout',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + 'auth/login/logout',
                        type: 'post',
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire({
                                icon: data.respond,
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = base_url + 'auth/login';
                            })
                        }
                    })
                }
            })


        })
    </script>
</body>



</html>