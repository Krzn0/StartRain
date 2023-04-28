<?php

$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);

$query2 = "
SELECT nh.nome_filho, nh.comentario, nh.horario, nh.dia, ig.path FROM notion_hospital nh join images ig on nh.horario = ig.horario 
";
$results2 = mysqli_query($conn, $query2);

// Exibir a imagem
echo "<img src='$path'>";

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
        <link rel="shortcut icon" href="../assets/images/Design sem nome.png">
        <title>Melhoras Vó!</title>
    </head>
    <body style="background-color: #101728;color: white">
    <div class="container" style="margin-top: 100px;">
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <a href="../login.php"><img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt=""></a>
            </div>
        </div>
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <h1 style="text-align: center">Anotações Conceição, Melhoras vó <img src="https://img.icons8.com/emoji/48/null/heart-suit.png"/></h1>
            </div>
        </div>

        <form id="myform" method="post" action="functionHospital.php" enctype="multipart/form-data">
            <div class="row" style="margin-bottom: 100px;">
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleInputPassword1" class="form-label">Nome Filho</label>
                    <input type="text" class="form-control" id="inputNomeUsuario" name="inputNomeUsuario">
                    <br>
                    <label for="formFileMultiple" class="form-label">Inserir Fotos</label>
                    <input class="form-control" type="file" id="image" name="image" multiple />
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Anotações</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="exampleFormControlTextarea1" rows="6"></textarea>
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                     
                </div>
                <div class="mb-3 col-xl-6 col-lg-12 col-sm-12" style="text-align: right;">
                    <button style="vertical-align: bottom;" id="liveToastBtn" type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form>


        <table class="table table-bordered table-dark table-striped" style="font-size: 1rem;">
            <thead>
                <tr>
                <th scope="col">Filho</th>
                <th scope="col">Anotação</th>
                <th scope="col">Horário</th>
                <th scope="col">Data</th>
                <th scope="col">Imagem</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results2)): ?>
                    <tr>
                        <td><?php echo $row['nome_filho']; ?></td>
                        <td><?php echo $row['comentario']; ?></td>
                        <td><?php echo $row['horario']; ?></td>
                        <td><?php echo $row['dia']; ?></td>
                        <td><img width="300px" height="300px" src="<?php echo $row['path']; ?>" alt=""></td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="../assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
                    <strong style="color: black; font-size: 1.2rem;" class="me-auto">Start Rain</strong>
                </div>
                <div class="toast-body" style="color: black;">
                    <p>Anotação Adicionado com Sucesso!</p>
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="../assets/images/Modern Geometric Finance Logo.png" style="max-width: 30%; max-height: 30%;" class="rounded me-2" alt="...">
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
            $("#myformm").submit(function(e) {
                e.preventDefault(); //previnir o comportamento padrão do formulário
                var formData = $(this).serialize(); // obtém os dados do formulário
                $.ajax({
                type: "POST",
                url: "functionHospital.php",
                data: formData,
                success: function(data) {
                    const toastTrigger = document.getElementById('liveToastBtn')
                    const toastLiveExample = document.getElementById('liveToast')
                    const toast = new bootstrap.Toast(toastLiveExample)
                    toast.show()
                    /* $("#inputNomeUsuario").val("");
                    $("#inputSenhaIncial").val("");
                    $("#inputApelido").val(""); */
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