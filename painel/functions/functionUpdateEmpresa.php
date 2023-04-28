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

$colorInput = $_POST['colorInput'];

$nome_empresa = $_SESSION['nome_empresa'];
$id_dono = $_SESSION['id_dono'];
$instagram_link = $_SESSION['instagram_link'];
$facebook_link = $_SESSION['facebook_link'];
$corTema = $_SESSION['corTema'];
$name_page = $_SESSION['page_name'];

$new_NomeEmp = $_POST['inputNomeEmpresa'];
$new_IdUsuario = $_POST['inputIdUsuario'];
$new_LinkInstagram = $_POST['inputLinkInstagram'];
$new_LinkFacebook = $_POST['inputLinkFacebook'];
$new_CorTema = $_POST['inputCorTema'];
$new_NomePagina = $_POST['inputNomePagina'];

echo $colorInput;

if (empty($_POST['inputNomeEmpresa'])) {
    $new_NomeEmp = $nome_empresa; 
    echo $new_NomeEmp.'<br>';
}else {
    echo $new_NomeEmp.'<br>';
}
if (empty($_POST['inputIdUsuario'])) {
    $new_IdUsuario = $id_dono; 
    echo $new_IdUsuario.'<br>';
}else {
    echo $new_IdUsuario.'<br>';
}
if (empty($_POST['inputLinkInstagram'])) {
    $new_LinkInstagram = $instagram_link; 
    echo $new_LinkInstagram.'<br>';
}else {
    echo $new_LinkInstagram.'<br>';
}
if (empty($_POST['inputLinkFacebook'])) {
    $new_LinkFacebook = $facebook_link; 
    echo $new_LinkFacebook.'<br>';
}else {
    echo $new_LinkFacebook.'<br>';
}
if (empty($_POST['inputCorTema'])) {
    $new_CorTema = $colorInput; 
    echo $new_CorTema.'<br>';
}else {
    echo $new_CorTema.'<br>';
}
if (empty($_POST['inputNomePagina'])) {
    $new_NomePagina = $name_page;
    echo $new_NomePagina.'<br>'; 
}else {
    echo $new_NomePagina.'<br>';
}

$query = "UPDATE cadEmpresa SET nameEmpresa = ?, id_client = ?, instagram_link = ?, facebook_link = ?, corTema = ?, page_name = ? WHERE id_client = ?";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "sissssi", $new_NomeEmp, $new_IdUsuario, $new_LinkInstagram, $new_LinkFacebook, $new_CorTema, $new_NomePagina, $id_dono);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt); 

// Close the connection
mysqli_close($conn);

header("Location:".'../'.$_SESSION['page_name'].".php");
exit();
?>