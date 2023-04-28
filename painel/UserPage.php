<?php
    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
        header("Location:login.php");
        exit();
    }
    $user_id = $_SESSION['id'];

    $host = "172.106.0.118";
    $user = "guiadmin";
    $password = "GuilhermeAbreu0909*";
    $dbname = "startrain";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    // Selecionar todos os dados da tabela "cadEmpresas"
    $query = "SELECT nameEmpresa, instagram_link, facebook_link, id_client, corTema FROM cadEmpresa where id_client= $user_id";
    $result = mysqli_query($conn, $query);
    $corTema='';
    while ($row = mysqli_fetch_assoc($result)) {
        $empresa = $row['nameEmpresa'];
        $corTema = $row['corTema'];
    }

    $query = "SELECT pedido_cliente, produto, dt_pedido, dt_entrega, valor_produto FROM pedidosEmpresa where id_cliente= $user_id";
    $resultPedidos = mysqli_query($conn, $query);
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
    <link rel="shortcut icon" href="assets/images/Design sem nome.png">
    <title>Bem vindo, <?php echo $_SESSION['nickname']?>!</title>
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-xl-12 col-lg-12 col-sm-12">
            <img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt="">
            </div>
        </div>
        <!-- <h1>Página Usuário</h1><br> -->
        <!-- <h2><?php echo $_SESSION['id'];?></h2> -->
        <h2 style="text-align: center; font-size: 30px; font-weight: bolder;">Olá <span style="color: <?php echo $corTema;?>;"><?php echo $empresa;?></span> tudo bem hoje? fique a vontade!</h2>

        <h2 style="text-align: left; font-size: 25px; margin-top: 100px;">Tabela de Pedidos</h2><br><br><br>
        <table class="table table-bordered table-dark table-striped">
            <thead>
                <tr>
                <th scope="col">Nome Cliente</th>
                <th scope="col">Produto</th>
                <th scope="col">Data do pedido</th>
                <th scope="col">Data de entrega</th>
                <th scope="col">Valor do produto</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultPedidos)): ?>
                    <tr>
                        <td><?php echo $row['pedido_cliente']; ?></td>
                        <td><?php echo $row['produto']; ?></td>
                        <td><?php echo $row['dt_pedido']; ?></td>
                        <td><?php echo $row['dt_entrega']; ?></td>
                        <td><?php echo $row['valor_produto']; ?></td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>  
    </div> 
</form>
</body>
</html>