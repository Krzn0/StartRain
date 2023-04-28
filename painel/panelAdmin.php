<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="admin") {
    header("Location:login.php");
    exit();
}

$current_page = basename($_SERVER['SCRIPT_NAME']);
$new_current_page = substr($current_page, 0, -4);
$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";
$conn = mysqli_connect($host, $user, $password, $dbname);
$idDonoEmail = $_SESSION['id_dono'];

$sql = "
SELECT ce.*
FROM cadEmpresa ce
WHERE ce.ativo=1 AND ce.page_name = '$new_current_page'
";
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($result)):
    $id_empresa = $row["id"];
    $nome_empresa = $row["nameEmpresa"];
    $link_insta = $row["instagram_link"];
    $link_face = $row["facebook_link"];
    $statusAtivo = $row["ativo"];
    $nome_pagina = $row["page_name"];
    $cor_tema = $row["corTema"];
    $id_dono = $row["id_client"];
    $_SESSION['id_dono'] = $id_dono;
    $_SESSION['nome_empresa'] = $nome_empresa;
    $_SESSION['instagram_link'] = $link_insta;
    $_SESSION['facebook_link'] = $link_face;
    $_SESSION['corTema'] = $cor_tema;
    $_SESSION['page_name'] = $nome_pagina;
endwhile;

$sqlEmail = "
select `um`.* from `users_clients` uc join `users_mails` um on um.`id_cliente` = uc.`id` where uc.id = '$idDonoEmail'
";
$resultEmail = mysqli_query($conn, $sqlEmail);

while ($row = mysqli_fetch_assoc($resultEmail)):
    $email_email = $row["email"];
    $email_pass = $row["passMail"];
    $email_smtp = $row["smtp"];
    $email_porta = $row["porta_smtp"];
endwhile;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="assets/cssStyle/reset.css" rel="stylesheet">
        <link href="assets/cssStyle/style.css" rel="stylesheet">
        <link href="assets/cssStyle/login.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="shortcut icon" href="assets/images/Design sem nome.png">
        <title>Bem vindo, <?php echo $_SESSION['nickname']?>!</title>
    </head>
    <body>
    <div class="container" style="margin-top: 100px;">
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <a href="AdminPage.php"><img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt=""></a>
            </div>
        </div>
        <h1 style="text-align:center; margin-bottom: 50px; font-size: 2rem;">Painel Administrativo&nbsp;<span style="color: <?php echo $cor_tema ?>"><?php echo $nome_empresa ?></span></h1>
    <!-- Inicio Accordion -->
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <!-- Primeiro Accordion -->
        <div class="accordion-item" style="background-color: #101728; border-color: <?php echo $cor_tema ?>;">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne" style="background-color: #101728; color: white; font-size: 1.5rem">
                    Configurações Gerais
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <form method="post" action="functions/functionUpdateEmpresa.php">
                        <div class="row" style="margin-bottom: 100px;">
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Nome Empresa</label>
                                <input type="text" class="form-control" id="inputNomeEmpresa" name="inputNomeEmpresa">
                                <div id="emailHelp" class="form-text">Atualmente o nome da Empresa é: <?php echo $nome_empresa ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Id Usuário (Dono)</label>
                                <input type="number" class="form-control" id="inputIdUsuario" name="inputIdUsuario">
                                <div id="emailHelp" class="form-text">Atualmente o Id Usuário é: <?php echo $id_dono ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Link Instagram</label>
                                <input type="text" class="form-control" id="inputLinkInsta" name="inputLinkInstagram">
                                <div id="emailHelp" class="form-text">Atualmente o Link do Instagram é: <?php echo $link_insta ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Link Facebook</label>
                                <input type="text" class="form-control" id="inputLinkFace" name="inputLinkFacebook">
                                <div id="emailHelp" class="form-text">Atualmente o Link do Facebook é: <?php echo $link_face ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Nome da Página</label>
                                <input placeholder="Em ajustes!" aria-label="Disabled input example" disabled type="" class="form-control" id="inputNomePagina" name="inputNomePagina">
                                <div id="emailHelp" class="form-text">Atualmente o nome da página é: <?php echo $nome_pagina ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                            <label for="exampleColorInput" class="form-label" style="text-align: left;">Cor Tema</label>
                                <input type="color" class="form-control form-control-color" id="exampleColorInput" name="colorInput" value="<?php echo $cor_tema ?>" title="Choose your color">
                                <div id="emailHelp" class="form-text">Atualmente a cor do tema é: <?php echo $cor_tema ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12"> 
                                
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Segundo Accordion -->
        <div class="accordion-item" style="background-color: #101728; border-color: <?php echo $cor_tema ?>;">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo" style="background-color: #101728; color: white; font-size: 1.5rem">
                    Configuração Email
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <form id='formMail' method="post">
                        <div class="row" style="margin-bottom: 100px;">
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <input type="text" class="form-control" id="inputEmail" name="inputEmail">
                                <div id="emailHelp" class="form-text">Atualmente o E-mail é: <?php echo $email_email ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Senha do Email</label>
                                <input type="text" class="form-control" id="inputPassMail" name="inputPassMail">
                                <div id="emailHelp" class="form-text">Atualmente a Senha é: <?php echo $email_pass ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">SMTP</label>
                                <input type="text" class="form-control" id="inputSMTP" name="inputSMPT">
                                <div id="emailHelp" class="form-text">Atualmente o SMTP é: <?php echo $email_smtp ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                                <label for="exampleInputPassword1" class="form-label">Porta SMTP</label>
                                <input type="number" class="form-control" id="inputPorta" name="inputPorta">
                                <div id="emailHelp" class="form-text">Atualmente a porta é: <?php echo $email_porta ?></div>
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12"> 
                                
                            </div>
                            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                                <button id="liveToastBtn" type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToastEmail" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
                    <strong style="color: black; font-size: 1.2rem;" class="me-auto">Start Rain</strong>
                </div>
                <div class="toast-body" style="color: black;">
                    <p>Email Atualizado com Sucesso!</p>
                </div>
            </div>
        </div>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToastEmailError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
                    <strong style="color: black; font-size: 1.2rem;" class="me-auto">Start Rain</strong>
                </div>
                <div class="toast-body" style="color: black;">
                    <p>Tropeçamos em alguns cabos, mas ja estamos resolvendo seu problema! :)</p>
                </div>
            </div>
        </div>
    <!-- Fim Accordion -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $("#formMail").submit(function(e) {
            e.preventDefault(); //previnir o comportamento padrão do formulário
            var formData = $(this).serialize(); // obtém os dados do formulário
            $.ajax({
            type: "POST",
            url: "functions/functionUpdateEmail.php",
            data: formData,
            success: function(data) {
                const toastTrigger = document.getElementById('liveToastBtn')
                const toastLiveExample = document.getElementById('liveToastEmail')
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
                $("#inputEmail").val("");
                $("#inputPassMail").val("");
                $("#inputPorta").val("");
                $("#inputSMTP").val("");
            },
            error: function(data) {
                const toastTrigger = document.getElementById('liveToastBtn')
                const toastLiveExample = document.getElementById('liveToastEmailError')
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            }
            });
        });
    });
    </script>
    </body>
</html>
  
  

