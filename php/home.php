<?php
session_start();
include_once('db.php');

$query = "SELECT * FROM colaborador";
$users = $conn->query($query);


if(isset($_SESSION['matricula'])){
    $matricula = $_SESSION['matricula'];
    $nivel = "SELECT * FROM colaborador WHERE matricula= '".$matricula."' ";
    $busca = mysqli_query($conn , $nivel);

    $usuarios = mysqli_fetch_assoc($busca);
    $nome = $usuarios['nome'];
    $matricula = $usuarios['matricula'];
    $entrada = $usuarios['entrada'];
    $saida = $usuarios['saida'];
    $data_criacao = $usuarios['data_criacao'];
    $data_atualizacao = $usuarios['data_atualizacao'];
    $deletado_em = $usuarios['deletado_em'];
    $nivel_acesso = $usuarios['nivel_acesso'];
    if ($nivel_acesso == 1) {
        $nivel_acesso == 'colaborador';
    }

  } else {
    header("Location: ../index.html");
  }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Título da página</title>
    </head>
<body>
    <p>seja bem vindo </p>
    <?php
    echo $nome ;
    ?>
</body>

</html>