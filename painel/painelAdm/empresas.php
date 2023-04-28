<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="admin") {
    header("Location:../login.php");
    exit();
}
header('Content-Type: text/html; charset=UTF-8');
require_once('../Classes/classUser.php');
require_once('../Classes/classEmpresa.php');
require_once('../Classes/classRedeSocial.php');
require_once('../Classes/classSorteio.php');
require_once('../Classes/class.Administradores.php');
include_once('includes/header.php');
cabecalho('Empresas - StartRain')
?>

<style>
    .card-body a{
        text-decoration: none !important;
        display: inline-block !important;
        width: auto !important;
        padding: 0px !important;
        color: #4E73E2 !important;
    }
</style>
<html lang="pt-br">
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php
        include_once('includes/sidebar.php');
        barralateral('Empresas')
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    include_once('includes/topbar.php');
                    barrasuperior()
                ?>   
                <!-- Begin Page Content -->
                <div class="container-fluid" style="color: white">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2">Empresas</h1><br>

                    <!-- DataTales Example -->
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-2 mb-4">
                            <!-- Project Card Example -->
                            <div class="card border-left-primary shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Gestão Empresas</h6>
                                </div>
                                <div class="card-body">
                                    <i style="font-size: 3rem;" class="fa-solid fa-gears"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 mb-4">
                            <!-- Approach -->
                            <div class="card border-left-purple shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Gestão Rede Social</h6>
                                </div>
                                <div class="card-body">
                                    <i style="font-size: 3rem;" class="fa-brands fa-instagram"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-4">
                            <!-- Approach -->
                            <div class="card border-left-success shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Gestão Lista Contatos</h6>
                                </div>
                                <div class="card-body">
                                <i style="font-size: 3rem;"  class="fa-solid fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-4">
                            <!-- Approach -->
                            <div class="card border-left-warning shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Gestão Pagamento</h6>
                                </div>
                                <div class="card-body">
                                    <i style="font-size: 3rem;" class="fa-solid fa-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-4">
                            <!-- Approach -->
                            <div class="card border-left-info shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Novo Usuário</h6>
                                </div>
                                <div class="card-body">
                                    <i style="font-size: 3rem;" class="fa-solid fa-user-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-4">
                            <!-- Approach -->
                            <div class="card border-left-danger shadow mb-4 dropdown-item" data-toggle='modal' data-target='#empresasModal'>
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold" style="font-size: 1.15rem;">Nova Empresa</h6>
                                </div>
                                <div class="card-body">
                                    <i style="font-size: 3rem;" class="fa-solid fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span style="color: white;">Copyright &copy; Start Rain 2023</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 style="color: black;" class="modal-title" id="exampleModalLabel">Não é um Adeus, é um até mais!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">Deseja encerrar a sessão e voltar para a tela de login?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="gearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 style="color: black;" class="modal-title" id="exampleModalLabel">Não é um Adeus, é um até mais!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black;">Deseja encerrar a sessão e voltar para a tela de login?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Gestão Empresa Modal-->
    <div class="modal fade" id="empresasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color: black;" class="modal-title" id="exampleModalLabel">Gestão das Empresas ativas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="row">
                <div class="col-lg-6">
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                </div>
                <div class="col-lg-6">
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                    <a class="btn btn-primary">Salvar</a>
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
    </script>

</body>

</html>