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

$email_email = $_POST['inputEmail'];
$email_pass = $_POST['inputPassMail'];
$email_smtp = $_POST['inputSMPT'];
$email_porta = $_POST['inputPorta'];
$email_idCliente = $_POST['inputIdCliente'];

$query = "
INSERT INTO users_mails (email, passMail, smtp, porta_smtp, id_cliente)
VALUES (?, ?, ?, ?, ?)
";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "sssii", $email_email, $email_pass, $email_smtp, $email_porta, $email_idCliente);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);

/* header("Location: ../AdminPage.php"); */
exit();
?>