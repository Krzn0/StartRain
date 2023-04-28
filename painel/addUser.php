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
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <h1 style="text-align: center">Adicionar novo Usuário</h1>
            </div>
        </div>

        <form id="myform" method="post">
            <div class="row" style="margin-bottom: 100px;">
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Nome Usuário</label>
                    <input type="text" class="form-control" id="inputNomeUsuario" name="inputNomeUsuario">
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Senha Inicial</label>
                    <input type="text" class="form-control" id="inputSenhaIncial" name="inputSenhaIncial">
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Apelido</label>
                    <input type="text" class="form-control" id="inputApelido" name="inputApelido">
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Permissão</label>
                    <select class="form-select" name='inputPermissao' aria-label="Default select example">
                        <option style="background-color: black; color: white;" value="user" selected>Usuário</option>
                        <option style="background-color: black; color: white;" value="admin">Administrador</option>
                    </select>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12"> 
                    
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                    <button style="vertical-align: bottom;" id="liveToastBtn" type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </form>

        <form id='formMail' method="post">
            <div class="row" style="margin-bottom: 100px;">
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail">
                    <div id="emailHelp" class="form-text">Email principal para Marketing e Recebimento de cobrança</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Senha do Email</label>
                    <input type="text" class="form-control" id="inputPassMail" name="inputPassMail">
                    <div id="emailHelp" class="form-text">Senha do Email</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">SMTP</label>
                    <input type="text" class="form-control" id="inputSMTP" name="inputSMPT">
                    <div id="emailHelp" class="form-text">Configuração SMTP do host do email</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Porta SMTP</label>
                    <input type="number" class="form-control" id="inputPorta" name="inputPorta">
                    <div id="emailHelp" class="form-text">Configuração da porta SMTP, evitar porta SSL</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Id Dono</label>
                    <input type="number" class="form-control" id="inputIdCliente" name="inputIdCliente">
                    <div id="emailHelp" class="form-text">Id Dono da empresa</div>
                </div>
                <!--<div class="mb-3 col-xl-6 col-lg-12 col-sm-12"> 
                    
                </div> -->
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                    <button id="liveToastBtn" type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </form>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
                    <strong style="color: black; font-size: 1.2rem;" class="me-auto">Start Rain</strong>
                </div>
                <div class="toast-body" style="color: black;">
                    <p>Usuário adicionado com sucesso!</p>
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
                    <strong style="color: black; font-size: 1.2rem;" class="me-auto">Start Rain</strong>
                </div>
                <div class="toast-body" style="color: black;">
                    <p>Algo deu errado, estamos ajeitando os cabos e já resolveremos!</p>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script>
        $(document).ready(function() {
            $("#myform").submit(function(e) {
                e.preventDefault(); //previnir o comportamento padrão do formulário
                var formData = $(this).serialize(); // obtém os dados do formulário
                $.ajax({
                type: "POST",
                url: "functions/functionInsertUser.php",
                data: formData,
                success: function(data) {
                    const toastTrigger = document.getElementById('liveToastBtn')
                    const toastLiveExample = document.getElementById('liveToast')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                    $("#inputNomeUsuario").val("");
                    $("#inputSenhaIncial").val("");
                    $("#inputApelido").val("");
                },
                error: function(data) {
                    const toastTrigger = document.getElementById('liveToastBtn')
                    const toastLiveExample = document.getElementById('liveToastError')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                }
                });
            });
        });

        $(document).ready(function() {
            $("#formMail").submit(function(e) {
                e.preventDefault(); //previnir o comportamento padrão do formulário
                var formData = $(this).serialize(); // obtém os dados do formulário
                $.ajax({
                type: "POST",
                url: "functions/functionInsertEmail.php",
                data: formData,
                success: function(data) {
                    const toastTrigger = document.getElementById('liveToastBtn')
                    const toastLiveExample = document.getElementById('liveToast')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                },
                error: function(data) {
                    const toastTrigger = document.getElementById('liveToastBtn')
                    const toastLiveExample = document.getElementById('liveToastError')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                }
                });
            });
        });
    </script>
    </body>
</html>
  
  

