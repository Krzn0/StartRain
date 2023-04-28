<?php
# git add: Adiciona as mudanças feitas nos arquivos ao índice (staging area). 
# Você pode adicionar arquivos específicos usando git add <nome_do_arquivo> ou adicionar todos os arquivos modificados com git add ..

# git commit: Registra as mudanças adicionadas ao índice em um novo commit com uma mensagem descritiva. 
# Para criar um commit, você pode usar git commit -m "Sua mensagem de commit".

# git push: Envia os commits locais para o repositório remoto. Para enviar suas mudanças para o branch atual, basta executar git push. 
# Se você deseja enviar as mudanças para um branch específico no repositório remoto, você pode usar git push origin <nome_do_branch>.

# git pull: busca as atualizações do repositório remoto e mescla as mudanças no branch atual de sua cópia local. 
# Assim, você garante que está trabalhando com a versão mais atualizada do código.

?>
<html>
  <head>
    <title>Exibir informações de arquivo XML - StartRain</title>
  </head>
  <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="arquivoXML">
      <input type="submit" value="Enviar">
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $arquivoXML = simplexml_load_file($_FILES['arquivoXML']['tmp_name']);
      displayXML($arquivoXML, 0);
    }

    function displayXML($xml, $level) {
      foreach ($xml as $element) {
        for ($i = 0; $i < $level; $i++) {
          echo "--";
        }
        echo "<b>" . $element->getName() . "</b><br>";
        foreach ($element->attributes() as $attribute => $value) {
          for ($i = 0; $i < $level + 1; $i++) {
            echo "--";
          }
          echo "Atributo: " . $attribute . " = " . $value . "<br>";
        }
        if ($element->count() > 0) {
          displayXML($element, $level + 1);
        } else {
          for ($i = 0; $i < $level + 1; $i++) {
            echo "--";
          }
          echo "Conteúdo: " . $element . "<br>";
        }
      }
    }
    ?>
  </body>
</html>
