<!DOCTYPE html>
<html lang="en">
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
    <link href="assets/cssStyle/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>

<div id="header" class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-sm-12">
          <img id="logoimg" width="300xp" height="75px" src="/assets/images/StartRainFundo.png" alt="">
        </div>
        <!-- <div class="col-xl-6 col-lg-6 col-sm-12">
          <button id="buttonSorteio" class="buttonStyle1">Registre-se</button>
        </div> -->
    </div>

<div class="container">
    <form action="functions/functionLogin.php" method="post" style="margin-top: 100px;">
    <div class="row">
        <div id="inputUser" class="col-xl-4 col-lg-6 col-sm-12">
            <h2>Usuário</h2>
            <br>
            <input class="inputValue" type="text" name="username" id="username">
            <br>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-12">
            <h2>Senha</h2>
            <br>
            <input class="inputValue" type="password" name="password" id="password">
            <br>
        </div>
        <div class="col-md-12">
            <br>
            <div style="display: flex; align-items: center; margin-top: 20px;">
                <input id="buttonLogin" type="submit" value="Entrar">
            </div>
        </div>
    </div>
  </form>
</div>

<!-- <div class="container" style="padding: 50px;">
        <form action="functionLogin.php" method="post">
            <div class="col-md-6">
                <div class="configdiv">
                    <label for="username">Usuário:</label>
                    <input type="text" name="username" id="username">
                    <br>
                </div>
            </div>
            <div class="col-md-6">
                <div class="configdiv">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password">
                    <br>
                </div>
            </div>
            <div class="col-md-12">
                <div class="configdiv">
                    <input type="submit" value="Entrar">
                </div>
            </div>
        </form>
</div> -->

</form>
</body>
</html>