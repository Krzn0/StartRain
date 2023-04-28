<?php

function connectionDb(){
    $servername = "172.106.0.118";
    $username = "guiadmin";
    $password = "GuilhermeAbreu0909*";
    $database_name = "startrain";

    $conn = mysqli_connect($servername, $username, $password, $database_name);
        
      // Check connection
      if($conn === false){
          die("ERROR: Could not connect. "
              . mysqli_connect_error());
      }
        
      // Taking all 5 values from the form data(input)
      $name =  $_REQUEST['name'];
      $codeSort = $_REQUEST['codeSort'];
      $phone =  $_REQUEST['phone'];
      $idade = $_REQUEST['idade'];
      $email = $_REQUEST['email'];
      $nameSelect = $_REQUEST['empresaSelect'];

      $query = "SELECT * FROM sorteioVerify WHERE codeSorteio='$codeSort' AND id_empresa=$nameSelect";
      $result = mysqli_query($conn, $query);
      $num_rows = mysqli_num_rows($result);

      if ($num_rows>0) {
        $query = "SELECT * FROM sorteioVerify WHERE codeSorteio='$codeSort' AND id_empresa=$nameSelect AND codeActive=1";
        $result = mysqli_query($conn, $query);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows>0) {
          if ($name<>'' and $codeSort<>'' and $phone<>'') {
            $sql = "INSERT INTO sorteioUser VALUES ('','$name','$codeSort','$phone','$email','$idade',$nameSelect)";
            
            if(mysqli_query($conn, $sql)){
              $sql = "UPDATE sorteioVerify SET codeActive=0 WHERE codeSorteio='$codeSort' AND id_empresa=$nameSelect AND codeActive=1";
              $result = mysqli_query($conn, $sql);
              session_start();
              $_SESSION['form_submitted'] = true;
              $sql = "INSERT INTO sorteioUser VALUES ('','$name','$codeSort','$phone','$email','$idade',$nameSelect)";
              echo "<script type='text/javascript'>alert('Parabéns, você está no sorteio!'); window.location='../sucesso.php'; </script>";
            }else{
                echo "ERROR: Hush! Sorry $sql."
                    . mysqli_error($conn);
            }
            // Close connection
            mysqli_close($conn);
          }else {
            echo "<script type='text/javascript'>alert('Preencha todos os campos obrigatórios!'); window.location='../index.php'; </script>";
          }
        }else {
          echo "<script type='text/javascript'>alert('O código ja foi utilizado!'); window.location='../index.php'; </script>";
        }
        }else {
          echo "<script type='text/javascript'>alert('Verifique o Código e o Estabelecimento!'); window.location='../index.php'; </script>";
        }
        

        
         
    };

connectionDb();

