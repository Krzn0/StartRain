<?php
date_default_timezone_set('America/Sao_Paulo');
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

$image = $_FILES['image'];
// Obter informações sobre a imagem
$name = $image['name'];
$type = $image['type'];
$size = $image['size'];
$tmp_name = $image['tmp_name'];
// Diretório onde a imagem será armazenada
$path = "images/$name";
$horario = date('H:i:s');
// Mover imagem para o diretório especificado
move_uploaded_file($tmp_name, $path);
// Inserir informações da imagem no banco de dados
$sql = "INSERT INTO images (name, path, type, size, horario) VALUES ('$name', '$path', '$type', '$size', '$horario')";
mysqli_query($conn, $sql);

$add_NomeFilho = $_POST['inputNomeUsuario'];
$add_Comentario = $_POST['exampleFormControlTextarea1'];
$hora = date('H:i:s');
$dia = date('d/m/Y'); 

$query = "
INSERT INTO notion_hospital (nome_filho, comentario, horario, dia)
VALUES (?, ?, ?, ?)
";

// Prepare sua consulta
$stmt = mysqli_prepare($conn, $query);

// Bind the variables to the placeholders
mysqli_stmt_bind_param($stmt, "ssss", $add_NomeFilho, $add_Comentario, $hora, $dia);

// Execute a consulta
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);

header("Location: conceicao.php");
exit();
?>