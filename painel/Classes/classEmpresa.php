<?php
$id_usuario = $_SESSION['id'];
$host = "172.106.0.118";
$user = "guiadmin";
$password = "GuilhermeAbreu0909*";
$dbname = "startrain";

$conn = mysqli_connect($host, $user, $password, $dbname);
// Verificação de conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

class Empresa {
    public $id;
    public $name;
    public $instagram_link;
    public $facebook_link;
    public $ativo;
    public $page_name;
    public $corTema;

    public function __construct($id, $name, $instagram_link, $facebook_link, $ativo, $page_name, $corTema) {
        $this->id = $id;
        $this->name = $name;
        $this->instagram_link = $instagram_link;
        $this->facebook_link = $facebook_link;
        $this->ativo = $ativo;
        $this->page_name = $page_name;
        $this->corTema = $corTema;
    }
}

$sql = "SELECT id, nameEmpresa, instagram_link, facebook_link, ativo, page_name, corTema FROM cadEmpresa WHERE id_client = $id_usuario";
$result = mysqli_query($conn, $sql);

$empresa = array();
while ($row = mysqli_fetch_assoc($result)) {
    $emp = new Empresa($row['id'], $row['nameEmpresa'], $row['instagram_link'], $row['facebook_link'], $row['ativo'], $row['page_name'], $row['corTema']);
    $empresa[] = $emp;
}


class EmpresasAtivas {
    public $id;
    public $name;
    public $instagram_link;
    public $facebook_link;
    public $ativo;
    public $page_name;
    public $corTema;

    public function __construct($id, $name, $instagram_link, $facebook_link, $ativo, $page_name, $corTema) {
        $this->id = $id;
        $this->name = $name;
        $this->instagram_link = $instagram_link;
        $this->facebook_link = $facebook_link;
        $this->ativo = $ativo;
        $this->page_name = $page_name;
        $this->corTema = $corTema;
    }
}

$sql = "SELECT id, nameEmpresa, instagram_link, facebook_link, ativo, page_name, corTema FROM cadEmpresa WHERE ativo = 1";
$result = mysqli_query($conn, $sql);

$empresasAtivas = array();
while ($row = mysqli_fetch_assoc($result)) {
    $emp = new EmpresasAtivas($row['id'], $row['nameEmpresa'], $row['instagram_link'], $row['facebook_link'], $row['ativo'], $row['page_name'], $row['corTema']);
    $empresasAtivas[] = $emp;
}
