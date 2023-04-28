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

class RedeSocial {
    public $Qtde_post;
    public $quantidade_seguidores;
    public $meta_anual;
    public $total_ads;

    public function __construct($Qtde_post, $quantidade_seguidores, $meta_anual, $total_ads) {
        $this->Qtde_post = $Qtde_post;
        $this->quantidade_seguidores = $quantidade_seguidores;
        $this->meta_anual = $quantidade_seguidores / $meta_anual * 100;
        $this->total_ads = $total_ads;
    }
}

$sql = "SELECT Qtde_post, quantidade_seguidores, meta_anual, total_ads FROM redes_sociais WHERE Id_cliente = $id_usuario";
$result = mysqli_query($conn, $sql);

$RedeSocial = array();
while ($row = mysqli_fetch_assoc($result)) {
    $RedeS = new RedeSocial($row['Qtde_post'],$row['quantidade_seguidores'], $row['meta_anual'], $row['total_ads']);
    $RedeSocial[] = $RedeS;
}
