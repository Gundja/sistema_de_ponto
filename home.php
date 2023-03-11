<?php
include_once('php/ponto.php');

error_reporting(0);
if (!$_SESSION['matricula']) {
    header("Location: login.php");
} 
$matricula = $_SESSION['matricula'];

  $nivel = "SELECT * FROM colaborador WHERE nivel_acesso = '0' AND matricula= '".$matricula."'";
  $user_lodado = mysqli_query($conn , $nivel);
  $usuarios = mysqli_fetch_assoc($user_lodado);

$nome_colaborador = $usuarios['nome'];

var_dump($nome_adm);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Relógio</title>

    <!-- STYLES -->
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Bubbler+One&display=swap" rel="stylesheet">
</head>
<body onload="startTime()">

    <section class="app">

        <div class="parentDate">
            <div class="date" id="date">""</div>  

            <div class="parentClock">
                <div class="clock" id="clock">""</div>  
            </div>
           
            <form action="sair.php">
                <p style="color:white;"> Olá, <?php  echo $nome_colaborador;?></p>
                <input type="submit" value="sair">
            </form>
            <form method="post" action="php/ponto.php">
                    <?php
                        if ($tipo == 1) {
                            $input =  '<input type="hidden" value ="0" name="tipo" >';
                            $tipo_marcacao = 'Saída'; 
                            $st ='Logado';
                            $status = "<p style='color: green;'>{$st}</p>";
                        }
                        elseif ($tipo == 0) {
                            $input =   '<input type="hidden" value ="1" name="tipo" >';
                            $tipo_marcacao = 'Entrada'; 
                            $st ='Deslogado';
                            $status = "<p style='color: red;'>{$st}</p>";
                        }
                        elseif (!$tipo) {
                            $input =   '<input type="hidden" value ="1" name="tipo" >';
                            $tipo_marcacao = 'Entrada';
                        }
                        echo $status;
                        echo $input;
                    ?>
                    <input type="submit" name="marcar" class="btn btn-success" value="Marcar <?php echo $tipo_marcacao; ?>">
            </form>
            <div class="clock-container">
            <div class="clock">
                <div class="hand hour" id="hour"></div>
                <div class="hand minute" id="minute"></div>
                <div class="hand second" id="second"></div>
                <div class="center-point" id="point"></div>
                <div class="indicadores"></div>
            </div>

            
        </div>
        
    </section>
    <!-- SCRIPTS -->
    <script src="app.js"></script>
    <script src="script.js"></script>
</body>
</html>