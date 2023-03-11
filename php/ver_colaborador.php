<?php
include_once('db.php');
error_reporting(0);

date_default_timezone_set('America/Sao_Paulo');
if (isset($_POST['ver'])) {
   $matricula = $_POST['matricul'];

    $nivel = "SELECT * FROM colaborador WHERE matricula= '".$matricula."'";
    $user_lodado = mysqli_query($conn , $nivel);
    $usuario = mysqli_fetch_assoc($user_lodado);


    $nome_colabora = $usuario['nome'];
    $matricula_colabora = $usuario['matricula'];
    $entrada_colabora = $usuario['entrada'];
    $saida_colabora = $usuario['saida'];
    $data_criacao_colabora = $usuario['data_criacao'];
    $data_atualizacao_colabora = $usuario['data_atualizacao'];
    $deletado_em_colabora = $usuario['deletado_em'];
    $periodo = substr($entrada_colabora, 0,2).":".substr($entrada_colabora, 2,2)." às ".substr($saida_colabora, 0,2).":".substr($saida_colabora, 2,2);
}
?>

<?php
session_start();
include_once('dados.php');

if (!$_SESSION['matricula']) {
  header("Location: ../login.php");
} 

if (isset($_POST['planilha'])) {
  header('Content-Type: text/csv; charset=utf-8');  
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gerenciamento de Usuario</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../dist/img/gundjatech.png" type="image/x-icon">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <a href="index2.html" class="logo">
        <span class="logo-mini">GundjaTech</span>
        <span class="logo-lg">GundjaTech</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="../dist/img/casi.jpeg" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $nome_adm; ?>  </span>
              </a>
                  <div class="pull-right">
                    <form method="POST"  action="sair.php">
                        <input type="submit" class="btn btn-default btn-red" name="Sair" value="Sair" >
                    </form>
                  </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">

      <section class="sidebar">

        <div class="user-panel">
          <div class="pull-left image">
            <img src="../dist/img/gundjatech.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>
              <?php echo $nome_adm; ?>  
            </p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MENU</li>
          <li class="active"><a href="../index.php"><i class="fa fa-users"></i> <span>Colaboradores</span></a></li>
          <li ><a href="#"><i class="fa fa-users"></i> <span>Controle de ponto</span></a></li>
        </ul>

      </section>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Colaborador
          <small>Gerenciamento de sistema</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">Ver Colaboradores</li>
        </ol>
      </section>

        <section class="content container-fluid">
            <div class="row">
            <div class="col-md-8">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><b> <?php echo $nome_colabora;?></b></h3>
                    <div class="right" style="float: right;">
                    
                    <form action="gerar_planilha.php" method="post" >
                        <input type="hidden" value="<?php echo $matricula_colabora;?>" name="matricula">
                        <input type="submit" style="background-color: #2db52d; color:white; border: none;" name="planilha" value="Gerer Relatório">
                    </form>

                    </div> 
                </div><br>
                    <div class="conteudo">
                        <p><b>Turno:</b> Tarde de <?php echo $periodo; ?></p> <p><b>Carga-Horária:</b> 8h</p><br>
                        <p>Horas Positivas:</p>
                        <p>Horas Negativas:</p> 

                        <div class="marcacoes">
                            
              
                        <div class="row">
                            <?php
                              $pontos = "SELECT DATE(data_marcacao), tipo, ponto, COUNT(*)  FROM ponto WHERE fk_colaborador= '".$matricula_colabora."' AND tipo = '1' GROUP BY DATE(data_marcacao) DESC";
                              $ponto = mysqli_query($conn , $pontos);
                              $marcacoes = array();
                              while ($row = mysqli_fetch_array($ponto)) {
                                $marcacoes_etrada[] = $row;
                              }


                              $pontos = "SELECT DATE(data_marcacao), tipo, ponto, COUNT(*)  FROM ponto WHERE fk_colaborador= '".$matricula_colabora."' AND tipo = '0' GROUP BY DATE(data_marcacao) DESC";
                              $ponto = mysqli_query($conn , $pontos);
                              $marcacoes = array();
                              while ($row = mysqli_fetch_array($ponto)) {
                                $marcacoes_saida[] = $row;
                              }

                              foreach ($marcacoes_saida as $key => $saida) {
                                $saiu = isset($saida[2]) ? $saida[2] : '---';
                              }

                              foreach ($marcacoes_etrada as $key => $marcacao) {
                                  $data =  substr($marcacao[0], 5,2)."/".substr($marcacao[0], 8,2) ;
                                  $horario = $marcacao[2];
                                  
                                    echo "
                                      <div class='col-12'>
                                        <!-- Timeline Area-->
                                        <div class='apland-timeline-area'>
                                            <!-- Single Timeline Content-->
                                            <div class='single-timeline-area'>
                                                <div class='timeline-date wow fadeInLeft' data-wow-delay='0.1s' style='visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;'>
                                                    <p>{$data}</p>
                                                </div>


                                                <div class='row'>
                                                    <div class='col-1 col-md-6 col-lg-4'>
                                                        <div class='single-timeline-content d-flex wow fadeInLeft' data-wow-delay='0.3s' style='visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;'>
                                                            <div class='timeline-icon'><i class='fa fa-address-card' aria-hidden='true'></i></div>
                                                            <div class='timeline-txt'>
                                                                <h6>entrada</h6>
                                                                <p>{$horario}</p><br>
                                                                <h6>saida</h6>
                                                                <p>{$saiu}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div> ";
                                }
                            ?>                           
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </section>
    </diV>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <a target="_blank" href="https://github.com/Gundja">GundjaTech</a>
            </div> Projeto desenvolvido por @Casimiro Gundja.
        </footer>

    </div>
   
    <script src="classes/Utils.js"></script>
    <script src="models/User.js"></script>
    <script src="controllers/UserController.js"></script>
    <script src="index.js"></script>
</body>

</html>