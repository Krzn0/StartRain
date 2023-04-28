<?php
include('includes/sorteio_info_gerais.php')
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=G-1XGM0JEJS6'></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1XGM0JEJS6');
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/cssStyle/reset.css" rel="stylesheet">
    <link href="assets/cssStyle/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/Design sem nome.png">
    <title>Start Rain - Sorteios</title>
</head>
<body>
    <div id="header" class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-12">
          <img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt="">
        </div>
        <div class="col-xl-6 col-lg-6 col-sm-12">
          <a href="login.php"><button id="buttonSorteio" class="buttonStyle1">Login</button></a>
        </div>
      </div>
    <form action="functions/functions.php" method="post" autocomplete="off">
      <div class="row" style="margin-top: 150px;">
        <div class="col-xl-4 col-lg-6 col-sm-12">
        <h2>Lugar de sua compra</h2>
        <br>
          <select name="empresaSelect">
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
                $id_empresa_sorteio = $row['id'];
                $empresa_sorteio = $row['nameEmpresa'];?>
                <option value="<?php echo $id_empresa_sorteio?>"><?php echo $empresa_sorteio?></option>
                <?php }
            ?>
          </select>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <h2>Nome</h2>
          <br>
          <input name="name" type="text">
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <h2>Telefone</h2>
          <br>
          <input name="phone" class="phone" type="text">
        </div>
      </div>
      <div class="row" style="margin-top: 50px;">
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <h2>Código</h2>
          <br>
          <input name="codeSort" type="text">
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <h2>Idade <span style="color: rgb(9, 150, 28);">(Opcional)</span></h2>
          <br>
          <input name="idade" type="text">
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-12">
          <h2>Email <span style="color: rgb(9, 150, 28);">(Opcional)</span></h2>
          <br>
          <input name="email" id="staticEmail" type="text">
        </div>
      </div>
      <div class="row" style="margin-top: 50px;">
        <div class="col-xl-12 col-lg-12 col-sm-12">
          <button type="submit" class="buttonStyle2">Enviar</button>
        </div>
      </div>
      <?php if(isset($_POST['submit'])){
          $phone = $_POST['phone'];
          $nome = $_POST['name'];
          $code = $_POST['code'];

          if(empty($nome) || empty($email) || empty($code)){
              echo "Por favor, preencha todos os campos obrigatórios!";
          }
      }?>
    </div>
  </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/master/src/jquery.mask.js"></script>
<script>
  $(document).ready(function(){
    $('body').on('focus', '.phone', function(){
        var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);

                if(field[0].value.length >= 14){
                    var val = field[0].value.replace(/\D/g, '');
                    if(/\d\d(\d)\1{7,8}/.test(val)){
                        field[0].value = '';
                        alert('Telefone Invalido');
                    }
                }
            }
        };
        $(this).mask(maskBehavior, options);
    });
});

</script>

</html>