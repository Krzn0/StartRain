<?php 
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}
include_once('includes/database.php');
dados_emails();

$id_usuario = $_SESSION['id'];
$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);
$query = "select * from users_clients where id = $id_usuario";
$result = $conn->query($query);
while ($row = mysqli_fetch_assoc($result)):
    $permissao_email = $row["permissao_email"];
endwhile;

global $conn, $email, $email_pass, $email_smtp, $email_porta, $sql;
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
include_once('includes/header.php');
cabecalho('StartRain - Email')
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php
        include_once('includes/sidebar.php');
        barralateral('Emails')
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
                <div class="container-fluid" style="color: black;">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Envio de Email de Marketing</h1>
                    <p class="mb-4">Esse painel é destinado à envio de e-mail massivos para Marketing, todas as listas de contatos devem ser de até 100 usuários,
                         o servidor tem a capacidade de enviar 100 e-mails a cada 2 horas, um total de 1.200 e-mails no dia e 36.000 no mês! Ao utilizar o servidor você concorda com as <a style="text-decoration: none; color: #4E73DF;" target="_blank" href="https://blog.e-goi.com/br/regulamentacao-email-marketing-o-que-precisa-saber/">Regras de Envios</a>.</p>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Conteúdo do Email</h6>
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data" action="servidor_email/functions_envio_email.php" method="post" class="row g-3">
                                        <div class="col-md-12">
                                            <label for="inputEmails" class="form-label">Email</label>
                                            <select id="inputEmails" class="form-select" name="inputEmails">
                                            <?php
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)):
                                                $email = $row["email"];
                                                $email_pass = $row["passMail"];
                                                $email_smtp = $row["smtp"];
                                                $email_porta = $row["porta_smtp"];?>
                                                <option><?php echo $email?></option>
                                                <!-- <option>Breno@conectambiental.com.br</option> -->
                                            <?php
                                            endwhile;
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Assunto</label>
                                            <input type="text" class="form-control" id="" name="inputAssunto">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Título</label>
                                            <input type="text" class="form-control" id="" name="inputTitulo">
                                        </div>
                                        <div class="mb-12">
                                            <label for="exampleFormControlTextarea1" class="form-label">Conteúdo do E-mail</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="inputCorpo"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="formFileMultiple" class="form-label">Inserir Anexo</label>
                                            <input class="form-control" type="file" id="image" name="image" multiple />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputListaContatos" class="form-label">Lista de Contatos</label>
                                            <select id="inputListaContatos" class="form-select" name="inputListaContatos">>
                                                <?php
                                                lista_contatos();
                                                $resultLista = mysqli_query($conn, $sqlContatos);
                                                while ($rowContatos = mysqli_fetch_assoc($resultLista)):
                                                    $nome_lista = $rowContatos["nome_lista"];?>
                                                    <option><?php echo $nome_lista?></option>
                                                <?php
                                            endwhile;
                                            ?>
                                            </select>
                                        </div>
                                       <!--  <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Eu li e concordo com estes <a style="text-decoration: none; color: #4E73DF" href="">termos e condições</a>.
                                                </label>
                                            </div>
                                        </div> -->
                                        
                                        <div class="col-12">
                                            <?php 
                                                if ($permissao_email){
                                                    echo '<button type="submit" class="btn btn-primary">Agendar</button>';
                                                }else {
                                                    echo '<button disabled type="submit" class="btn btn-primary">Agendar</button>';
                                                }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Aviso do Desenvolvedor</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    Olá <span style="color: #4E73DF;"><?php echo $_SESSION['nickname']?></span>, o envio de email está pronto, porém em beta-teste, então ainda podem aparecer alguns probleminhas, mas você já pode usufruir dessa ferramenta incrível!<br><br>Att, <span style="color: #4E73DF;">Gui 😊</span>        
                                </div>
                            </div>
                                <!-- Card Header - Dropdown -->
                                <!-- <?php
                                    lista_contatos();
                                    $resultLista = mysqli_query($conn, $sqlContatos);
                                    while ($rowContatos = mysqli_fetch_assoc($resultLista)):
                                        $nome_lista = $rowContatos["nome_lista"];?>
                                        <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $nome_lista?></h6>
                                        </div>
                                        <div class="card-body">
                                            Olá <span style="color: #4E73DF;"><?php echo $name_user?></span>, o envio de email em massa está quase concluido, tenha somente mais um pouco de paciência, logo menos você já poderá usufruir dessa ferramenta incrível!<br><br>Att, <span style="color: #4E73DF;">Gui 😊</span>        
                                        </div>
                                    </div>
                                    <?php
                                    endwhile;
                                    ?> -->
                            
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
                    <a class="btn btn-primary" href="../login.php">Sair</a>
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
    <script src="js/demo/chart-bar-demo.js"></script>

</body>

</html>