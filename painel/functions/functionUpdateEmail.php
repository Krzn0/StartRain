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
$idDonoEmail = $_SESSION['id_dono'];

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

if (empty($_POST['inputEmail'])) {
    $email_email = $email_email; 
}else {
    $email_email = $_POST['inputEmail'];
}
if (empty($_POST['inputPassMail'])) {
    $email_pass = $email_pass; 
}else {
    $email_pass = $_POST['inputPassMail'];
}
if (empty($_POST['inputSMPT'])) {
    $email_smtp = $email_smtp; 
}else {
    $email_smtp = $_POST['inputSMPT'];
}
if (empty($_POST['inputPorta'])) {
    $email_porta = $email_porta; 
}else {
    $email_porta = $_POST['inputPorta'];
}


$query = "UPDATE users_mails SET email = ?, passMail = ?, smtp = ?, porta_smtp = ? WHERE id_cliente = ?";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "sssii", $email_email, $email_pass, $email_smtp, $email_porta, $idDonoEmail);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt); 

// Close the connection
mysqli_close($conn);

header("Location:".'../'.$_SESSION['page_name'].".php");
exit();
?>