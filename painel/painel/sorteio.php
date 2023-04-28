<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}
header('Content-Type: text/html; charset=UTF-8');
require_once('../Classes/classUser.php');
require_once('../Classes/classEmpresa.php');
require_once('../Classes/classRedeSocial.php');
require_once('../Classes/classSorteio.php');
include_once('includes/header.php');
cabecalho('StartRain - Sorteio')
?>
<html lang="pt-br">
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php
        include_once('includes/sidebar.php');
        barralateral('Sorteios')
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
                <div class="container-fluid" style="color: black">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Sorteio</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Participantes do Sorteio</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Código</th>
                                            <th>Telefone</th>
                                            <th>Email</th>
                                            <th>Idade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sorteio as $sorteio) {
                                            echo '<tr>';
                                            echo '<td>'.mb_convert_encoding($sorteio->name, "UTF-8", "ISO-8859-1").'</td>';
                                            echo '<td>'.$sorteio->codeSort.'</td>';
                                            echo '<td>'.$sorteio->phone.'</td>';
                                            echo '<td>'.$sorteio->email.'</td>';
                                            echo '<td>'.$sorteio->idade.'</td>';
                                            echo '</tr>';
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span style="color: black;">Copyright &copy; Start Rain 2023</span>
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

</body>

</html>