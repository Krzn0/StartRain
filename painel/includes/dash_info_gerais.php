<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
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


$queryRs = "SELECT * FROM redes_sociais WHERE Id_cliente = $user_id";
$resultRs = mysqli_query($conn, $queryRs);
while ($row = mysqli_fetch_assoc($resultRs)) {
    $qtde_post = $row['Qtde_post'];
    $qtde_seguidores = $row['quantidade_seguidores'];
    $meta_anual = $qtde_seguidores / $row['meta_anual'] * 100 ;
    $total_ads = $row['total_ads'];
}


?>