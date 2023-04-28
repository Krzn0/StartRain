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
