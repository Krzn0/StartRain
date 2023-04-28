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
$query = "SELECT id, nameEmpresa FROM cadEmpresa";
$result = mysqli_query($conn, $query);
/* while ($row = mysqli_fetch_assoc($result)) {
    $id_empresa = $row['id'];
    $nameEmpresa = $row['nameEmpresa'];
} */

$query2 = "SELECT id, nameEmpresa FROM cadEmpresa WHERE id_client = $user_id";
$result2 = mysqli_query($conn, $query2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $id_empresa2 = $row2['id'];
    $nameEmpresa2 = $row2['nameEmpresa'];
}

$querySorteio = "SELECT name, codeSort, phone, email, idade FROM sorteioUser WHERE empresa = $id_empresa2";
$resultSorteio = mysqli_query($conn, $querySorteio);
/* while ($rowSorteio = mysqli_fetch_assoc($resultSorteio)) {
    
} */




?>