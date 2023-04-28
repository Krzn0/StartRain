<?php 
session_start();
function cabecalho($nomePagina)
{
echo "
<head>
<!-- Google tag (gtag.js) -->
<script async src='https://www.googletagmanager.com/gtag/js?id=G-1XGM0JEJS6'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1XGM0JEJS6');
</script>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<meta name='description' content='Start Rain'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
<link rel='shortcut icon' href='../assets/images/Design sem nome.png'>
<meta name='author' content='Start Rain'>


<title>{$nomePagina}</title>

<!-- Custom fonts for this template-->
<link href='https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet'>

<!-- Custom styles for this template-->
<link href='css/sb-admin-2.css' rel='stylesheet'>
<link href='../cssStyle/painel.css' rel='stylesheet'>
<link href='css/notion.css' rel='stylesheet'>
<script src='https://kit.fontawesome.com/7591fc6705.js' crossorigin='anonymous'></script>
</head> 

<style>
    div .card, .card-header{
        background-color: #292F45;
        color: white !important;
        border: #292F45;
    }
    div .card p{
        color: white !important;
    }
    #content-wrapper, #page-top{
        background-color: #101728 !important;
    }
    .sticky-footer{
        background-color: #101728 !important;
    }
    body{
        color: white !important;
    }
</style>
";
}
?>