<?php
session_start();
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

$new_NomeEmp = $_POST['addNomeEmpresa'];
$new_IdUsuario = $_POST['addIdUsuario'];
$new_LinkInstagram = $_POST['addLinkInstagram'];
$new_LinkFacebook = $_POST['addLinkFacebook'];
$new_CorTema = $_POST['addColorInput'];
$new_NomePagina = $_POST['addNomePagina'];

$query = "
INSERT INTO cadEmpresa (nameEmpresa, instagram_link, facebook_link, id_client, page_name, corTema)
VALUES (?, ?, ?, ?, ?, ?)
";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "sssiss", $new_NomeEmp, $new_LinkInstagram, $new_LinkFacebook, $new_IdUsuario, $new_NomePagina, $new_CorTema);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);

/* header("Location: ../AdminPage.php"); */
exit();
?>