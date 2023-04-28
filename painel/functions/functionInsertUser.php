<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="admin") {
    header("Location:login.php");
    exit();
}

// Conexão com o banco de dados
$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Verificação de conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$add_NomeUser = $_POST['inputNomeUsuario'];
$add_SenhaInicial = $_POST['inputSenhaIncial'];
$add_Apelido = $_POST['inputApelido'];
$add_Permissao = $_POST['inputPermissao'];

$query = "
INSERT INTO users_clients (name_user, password_user, nick_name, permissao)
VALUES (?, ?, ?, ?)
";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "ssss", $add_NomeUser, $add_SenhaInicial, $add_Apelido, $add_Permissao);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);

/* header("Location: AdminPage.php");
exit(); */
}
?>