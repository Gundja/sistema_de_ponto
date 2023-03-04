<?php
session_start();
include_once('php/dados.php');

if (!$_SESSION['matricula']) {
  header("Location: login.php");
} 

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gerenciamento de Usuario</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="shortcut icon" href="dist/img/gundjatech.png" type="image/x-icon">
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
                <img src="dist/img/casi.png" class="user-image" alt="User Image">
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
            <img src="dist/img/gundjatech.png" class="img-circle" alt="User Image">
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
          <li class="active"><a href="index.php"><i class="fa fa-users"></i> <span>Colaboradores</span></a></li>
          <li ><a href="#"><i class="fa fa-users"></i> <span>Controle de ponto</span></a></li>
        </ul>

      </section>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Colaboradores
          <small>Gerenciamento de sistema</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">Colaboradores</li>
        </ol>
      </section>

      <section class="content container-fluid">

        <div class="row">
          <div class="col-md-8">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista de Colaboradores</h3>
                <div class="right" style="float: right;">
                  <a href="">
                    <img src="dist/img/csv.png" alt="geral planilha" style="width: 25px;">
                  </a>
                </div>    
              </div>

              <div class="box-body no-padding">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Matrícula</th>
                    <th scope="col">período</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($colaboradores as $key => $cliente) {
                      $id_parceiro = $cliente['id'];
                      $nome = $cliente['nome'];
                      $matricula = $cliente['matricula'];
                      $entrada = str_pad($cliente['entrada'], 4, "0", STR_PAD_LEFT);
                      $saida = str_pad($cliente['saida'], 4, "0", STR_PAD_LEFT);
                      $periodo = substr($entrada, 0,2).":".substr($entrada, 2,2)." às ".substr($saida, 0,2).":".substr($saida, 2,2);

                      $deletado_em = $cliente['deletado_em'];
                      $nivel_acesso = $cliente['nivel_acesso'];
                      if ($deletado_em == null) {
                        $deletado_em = 'ativo';
                      }
                      echo "<tr>";
                          echo "<th scope='row'>".$nome."</th>";
                          echo "<th scope='row'>".$matricula."</th>";
                          echo "<th scope='row'>".$periodo."</th>";
                          echo "<th scope='row'>".$deletado_em."</th>";
                          echo "<th scope='row'>
                          
                          
                            <a href='#'> <img src='dist/img/editar.png' alt='Apagar' style='width: 15px;'></a>
                            <a href='#'> <img src='dist/img/lixo.png' alt='Apagar' style='width: 15px;'></a>
                            <a href='#'> <img src='dist/img/olho.png' alt='Apagar' style='width: 17px;'></a>
                            <input type='hidden'  value=".$id_parceiro." name='acao'>
                         
                      
                          </form>
                          </th>";
                      echo "</tr>";                    
                    }
                    ?>
                </tbody>
              </table>
                  </div>
            </div>
            
          </div>
          <div class="col-md-4">

            <div class="row">

              <div class="col-xs-6">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3 id="number-users"><?php echo $key_colabora; ?></h3>

                    <p>Colaboradores</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3 id="number-users-admin"><?php echo $key_adm; ?></h3>

                    <p>Administradores</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="box box-success" id="box-user-create">
              <div class="box-header with-border">
                <h3 class="box-title">Novo Colaboradores</h3>
              </div>
            <p><?php echo  isset($mensagem) ? $mensagem: ''; ?></p>

              <form role="form" action="php/cadastrar.php" method="POST">

                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputName">Nome</label>
                        <input type="text" required class="form-control" id="exampleInputName"
                          placeholder="Digite o nome do usuário" name="nome">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputBirth">Entrada</label>
                        <input type="time" class="form-control" id="exampleInputBirth" value="<?php echo date('H:i')?>" name="entrada">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputBirth">Saída</label>
                        <input type="time" class="form-control" id="exampleInputBirth" value="<?php echo date('H:i')?>" name="h_saida">
                      </div>
                    </div>

                    <input type="hidden" name="data_criacao" value="<?php date('d-m-Y')?>">
                    <input type="hidden" name="data_atualizacao" value="<?php date('d-m-Y')?>">
                    <input type="hidden" name="senha" value="1234">
                    <input type="hidden" name="nivel_acesso" value="0">

                    <div class="box-footer">
                          <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar" >
                    </div>

              </form>
            </div>
            </div>
          </div>
        </div>

      </section>

    </diV>




    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <a target="_blank" href="https://github.com/Gundja">GundjaTech</a>
      </div>
      Projeto desenvolvido por @Casimiro Gundja.
    </footer>

  </div>
  
  <script src="classes/Utils.js"></script>
  <script src="models/User.js"></script>
  <script src="controllers/UserController.js"></script>
  <script src="index.js"></script>
</body>

</html>