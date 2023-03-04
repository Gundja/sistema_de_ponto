<?php
include_once('php/ponto.php');

if (!$_SESSION['matricula']) {
    header("Location: login.php");
  } 
?>

<!DOCTYPE html>
<html lang="pt-br" class="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Relógio</title>
</head>

<body>

    <div class="pull-right">
    <form method="POST"  action="sair.php">
        <input type="submit" class="btn btn-default btn-red" name="Sair" value="Sair" >
    </form>
    </div>


    <div class="clock-container">
            <div class="clock">
                <div class="hand hour" id="hour"></div>
                <div class="hand minute" id="minute"></div>
                <div class="hand second" id="second"></div>
                <div class="center-point" id="point"></div>
                <div class="indicadores"></div>
            </div>

        <div class="time" id="time"></div>
        <div class="date" id="date"></div>
        <div id="toggle2"></div>       
    </div>
  
    <form method="post" action="php/ponto.php">
        <?php
            if ($tipo == 1) {
                $input =  '<input type="hidden" value ="0" name="tipo" >';
                $tipo_marcacao = 'Saída'; 
            }
            elseif ($tipo == 0) {
                $input =   '<input type="hidden" value ="1" name="tipo" >';
                $tipo_marcacao = 'Entrada'; 
            }

            echo $input;
        ?>
        <input type="submit" name="marcar" class="btn btn-success" value="Marcar <?php echo $tipo_marcacao; ?>">
    </form>
  
    <script src="assets/js/script.js"></script>
</body>
</html>