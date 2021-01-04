<?php
if ($this->session->userdata('email') != '') {

    redirect(base_url('auth/dashboard'), 'refresh');
}

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

    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/sbadmin2/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?= $title ?></h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="email" id="email" class="form-control form-control-user" placeholder="Enter Email..." autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" class="form-control form-control-user" placeholder="Password" autocomplete="off">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/sbadmin2/') ?>js/sb-admin-2.min.js"></script>
    <script>
        const base_url = '<?= base_url('/') ?>'

        $('form.user').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: base_url + 'auth/login/proses',
                type: 'post',
                dataType: 'json',
                data: {
                    email: $('input#email').val(),
                    password: $('input#password').val()
                },
                success: function(data) {
                    console.log(data);
                    if (data.respond == 'success') {
                        Swal.fire({
                            icon: data.respond,
                            title: data.title,
                            html: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = base_url + 'auth/dashboard';
                        });
                    } else {
                        Swal.fire({
                            icon: data.respond,
                            title: data.title,
                            html: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            })
        })
    </script>

</body>

</html>