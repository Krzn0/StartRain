<?php 

session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}


include('../includes/database.php');

connectionDb();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpMailer/src/Exception.php';
require '../../phpMailer/src/PHPMailer.php';
require '../../phpMailer/src/SMTP.php';

$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);
$id_usuario = $_SESSION['id'];
// Verificação de conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$email_envio = $_POST['inputEmails'];
$assunto = $_POST['inputAssunto'];
$corpo = $_POST['inputCorpo'];
$titulo = $_POST['inputTitulo'];
$listaContatos = $_POST['inputListaContatos'];
$image = $_FILES['image'];

if (is_uploaded_file($image['tmp_name']) && getimagesize($image['tmp_name'])) {
    // Obter informações sobre a imagem
    $name = $image['name'];
    $type = $image['type'];
    $size = $image['size'];
    $tmp_name = $image['tmp_name'];

    // Diretório onde a imagem será armazenada
    $path = "imagesServer/$name";
    $horario = date('H:i:s');

    // Mover imagem para o diretório especificado
    move_uploaded_file($tmp_name, $path);
} else {
    /* echo "<script type='text/javascript'>alert('Arquivo não é uma imagem válida ou não foi enviado com sucesso.'); window.location='../email.php'; </script>" */;
}

// Inserir informações da imagem no banco de dados
$sql = "INSERT INTO images (name, path, type, size, horario) VALUES ('$name', '$path', '$type', '$size', '$horario')";
mysqli_query($conn, $sql);

$sql = "SELECT * FROM users_mails WHERE email = '$email_envio'";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)):
    $email_pass = $row["passMail"];
    $email_smtp = $row["smtp"];
    $email_porta = $row["porta_smtp"];
endwhile;

$query = "select `cl`.* from contatos_lista cl join `lista_contatos` lc on cl.`id_lista`=lc.`id` where `lc`.`nome_lista`= '$listaContatos'";
$result = $conn->query($query);
$contacts = $result->fetch_all(MYSQLI_ASSOC);

$query = "select * from cadEmpresa where id_client = $id_usuario";
$result = $conn->query($query);
$empresa = $result->fetch_all(MYSQLI_ASSOC);

// Create a new PHPMailer object
$mail = new PHPMailer;

// Configure SMTP settings
$mail->isSMTP();
$mail->Host = $email_smtp;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Username = $email_envio;
$mail->Password = $email_pass;
$mail->SMTPAuth = true;
$mail->Port = $email_porta;

// Set the sender and subject
$mail->setFrom($email_envio, 'Teste');
$mail->Subject = $assunto;
// Set the body of the email
$mail->msgHTML($corpo);
$mail->addAttachment($path, $name);
/* $mail->msgHTML($corpo.' <br><img src='.$path.'>'); */

// Add each recipient to the email
foreach ($contacts as $contact) {
    $mail->addAddress($contact['email']);
}

// Send the email
if (!$mail->send()) {
    echo "<script type='text/javascript'>alert('Mailer Error: ' . $mail->ErrorInfo;); window.location='../email.php'; </script>";
} else {
    $sql = "UPDATE users_clients SET permissao_email = 0 WHERE id=$id_usuario";
    $result = mysqli_query($conn, $sql);
    echo "<script type='text/javascript'>alert('E-mails enviados com sucesso!'); window.location='../email.php'; </script>";
}