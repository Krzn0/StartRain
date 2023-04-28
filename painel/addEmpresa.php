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
                <h1 style="text-align: center">Adicionar nova Empresa</h1>
            </div>
        </div>

        <form id="myform" method="post">
            <div class="row" style="margin-bottom: 100px;">
            <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Nome Empresa</label>
                    <input type="text" class="form-control" id="inputNomeEmpresa" name="addNomeEmpresa">
                    <div id="emailHelp" class="form-text">Nome da Empresa disponível para o Usuário</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Id Usuário (Dono)</label>
                    <input type="number" class="form-control" id="inputIdUsuario" name="addIdUsuario">
                    <div id="emailHelp" class="form-text">Id do Usuário que terá acesso à empresa</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Link Instagram</label>
                    <input type="text" class="form-control" id="inputLinkInsta" name="addLinkInstagram">
                    <div id="emailHelp" class="form-text">Link do Instagram da empresa</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Link Facebook</label>
                    <input type="text" class="form-control" id="inputLinkFace" name="addLinkFacebook">
                    <div id="emailHelp" class="form-text">Link do Facebook da empresa</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Nome da Página</label>
                    <input type="" class="form-control" id="inputNomePagina" name="addNomePagina">
                    <div id="emailHelp" class="form-text">Nome da página de controle no painel, evitar espaços e caracteres especiais!</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                <label for="exampleColorInput" class="form-label" style="text-align: left;">Cor Tema</label>
                    <input type="color" class="form-control form-control-color" id="exampleColorInput" name="addColorInput" value="<?php echo $cor_tema ?>" title="Choose your color">
                    <div id="emailHelp" class="form-text">Cor do Tema utilizado no painel de usuário</div>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12"> 
                    
                </div>
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
                    <p>Adicionado com sucesso!</p>
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
                url: "functions/functionInsertEmpresa.php",
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
  
  

