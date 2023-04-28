<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['permissao']!="user") {
    header("Location:../login.php");
    exit();
}

function connectionDb(){
    /* 
    $_SESSION['username'];
    $_SESSION['permissao'];
    $_SESSION['id'];
    $_SESSION['nickname']; 
    */
    global $conn;
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
}

function dados_emails(){
    global $conn, $email, $email_pass, $email_smtp, $email_porta, $sql, $name_user;
    connectionDb();
    $id_usuario = $_SESSION['id'];
    $name_user = $_SESSION['username'];
    $sql = "SELECT * FROM users_mails WHERE id_cliente = $id_usuario";
    return $sql;
}

function lista_contatos(){
    global $conn, $email, $email_pass, $email_smtp, $email_porta, $sqlContatos, $name_user;
    connectionDb();
    $id_usuario = $_SESSION['id'];
    $name_user = $_SESSION['username'];
    $sqlContatos = "SELECT * FROM lista_contatos WHERE id_cliente = $id_usuario";
    return $sqlContatos;
}