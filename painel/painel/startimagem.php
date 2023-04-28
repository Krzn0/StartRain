<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}
include('../includes/dash_info_gerais.php');
include_once('../apidalle.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
include_once('includes/header.php');
cabecalho('StartRain - Gerador Imagem')
?>

<body id="page-top" style="background-color: #101728; ;">

    <!-- Page Wrapper -->
    <div id="wrapper" style="background-color: #101728;">

    <?php
        include_once('includes/sidebar.php');
        barralateral('Dalle')
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> IA Geradora de Imagem - StartRain</h1>
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row"> -->

                    <!-- Content Row -->

                    <!-- <div class="row"> -->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gerador de Imagem</h6>
                                </div>
                                <div class="card-body">
                                    <form id="formIa" method="post" class="row g-3">
                                        <div class="col-md-6">
                                            <label style="color: black;" for="inputEmail4" class="form-label">Descrição da Imagem</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="inputDesc"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button id="submit-button" type="submit" class="btn btn-primary">Gerar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Aviso do Desenvolvedor</h6>
                                </div>
                                <div class="card-body">
                                <p style="color: black;">Olá, <span style="color: #4E73E2;"><?php echo $_SESSION['nickname']?></span>, essa é uma integração com a inteligência artificil Dall-e, aqui você pode gerar imagens à vontade,
                                detalhe oque você quer e espere que a mágica aconteça. Eu sou o <a style="text-decoration: none; color: #4E73E2" href="">Gui</a>, responsável por trazer novidades e automações para você,
                                fique a vontade para entrar em contato comigo para sugestões ou correções do site 🙂</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Resultado do Gerador</h6>
                                </div>
                                <div class="card-body">
                                    <?php 
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            $resultadoIa = geradorIa($_POST['inputDesc']);
                                            header('Location: startimage.php');
                                            echo $resultadoIa;
                                        }   
                                    ?>
                                </div>
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
    <script>
    if (screen.width < 1000) {
        document.getElementById("submit-button").disabled = true;
    }
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>