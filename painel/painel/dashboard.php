<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}
/* include('../includes/dash_info_gerais.php'); */
require_once('../Classes/classUser.php');
require_once('../Classes/classEmpresa.php');
require_once('../Classes/classRedeSocial.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
include_once('includes/header.php');
cabecalho('StartRain - Dashboard')
?>

<body id="page-top" style="background-color: #101728; ;">

    <!-- Page Wrapper -->
    <div id="wrapper" style="background-color: #101728;">

    <?php
        include_once('includes/sidebar.php');
        barralateral('Dashboard')
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard - 
                        <?php foreach ($empresa as $empresa) {
                            echo $empresa->name;
                        }?>
                        </h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Posts (Anual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php foreach ($RedeSocial as $RedeSocial) {
                                                    echo $RedeSocial->Qtde_post;
                                                }?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                            <img src="../assets/icons/postsDash.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Seguidores (Redes Sociais)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                    echo number_format($RedeSocial->quantidade_seguidores, 0, ",", ".");
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                            <img src="../assets/icons/seguidoresDash.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Meta Seguidores Anual
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($RedeSocial->meta_anual, 0, ",", ".")?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo number_format($RedeSocial->meta_anual, 0, ",", ".")?>%" aria-valuenow="<?php echo number_format($RedeSocial->meta_anual, 0, ",", ".")?>" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                                            <img src="../assets/icons/metaDash.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Valor Investido em ADS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$<?php echo number_format($RedeSocial->total_ads, 2, ",", ".")?></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <img src="../assets/icons/adsDash.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Novidades em Breve!</h6>
                                </div>
                                <div class="card-body">
                                    <h4 style="color: black;" class="small font-weight-bold">Servidor de Email de Marketing<span
                                            class="float-right">99%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 99%"
                                            aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 style="color: black;" class="small font-weight-bold">Servidor de Menssagens por WhatsApp<span
                                            class="float-right">30%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 style="color: black;" class="small font-weight-bold">Inteligência Artificial (Gerador Imagem)<span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 style="color: black;" class="small font-weight-bold">Mecanismo de Sorteio para Empresas<span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 style="color: black;" class="small font-weight-bold">Configuração da sua Conta<span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>ReseSocial

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Avisos do Desenvolvedor</h6>
                                </div>
                                <div class="card-body">
                                <p style="color: black;">Olá, <span style="color: #4E73E2;"><?php echo $_SESSION['nickname']?></span>, tudo bem? Espero que sim! Acredito que esteja preparado(a)
                                para nossa parceria, tenho certeza que você não irá se arrepender, eu sou o <a style="text-decoration: none; color: #4E73E2" href="">Gui</a>, responsável por trazer novidades e automações para você,
                                fique a vontade para entrar em contato comigo para sugestões ou correções do site 🙂</p>
                                <!-- <p style="color: black;" class="mb-0">Before working with this theme, you should become familiar with the
                                    Bootstrap framework, especially the utility classes.</p> -->
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Sugestões de Inovações</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                    <label style="color: black; font-weight: bold;" for="exampleFormControlInput1" class="form-label">Título da idéia</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Bot WhatsApp">
                                    </div>
                                    <div class="mb-3">
                                    <label style="color: black; font-weight: bold;" for="exampleFormControlTextarea1" class="form-label">Explicações do Projeto</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                    <div style="padding-left: 0px;" class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3">Enviar Sugestão</button>
                                    </div>
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