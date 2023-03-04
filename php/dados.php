<?php
// session_start();
include_once('db.php');
date_default_timezone_set('America/Sao_Paulo');

if(isset($_SESSION['matricula'])){
  $matricula = $_SESSION['matricula'];
  $nivel = "SELECT * FROM colaborador WHERE nivel_acesso = '1' AND matricula= '".$matricula."'";
  $user_lodado = mysqli_query($conn , $nivel);
  $usuarios = mysqli_fetch_assoc($user_lodado);

    $nome_adm = $usuarios['nome'];
    $matricula_adm = $usuarios['matricula'];
    $entrada_adm = $usuarios['entrada'];
    $saida_adm = $usuarios['saida'];
    $data_criacao_adm = $usuarios['data_criacao'];
    $data_atualizacao_adm = $usuarios['data_atualizacao'];
    $deletado_em_adm = $usuarios['deletado_em'];
  } else {
    header("Location: ../login.html");
  }

$query = "SELECT * FROM colaborador WHERE nivel_acesso = '0' ";
$resultado = mysqli_query($conn, $query);

$colaboradores = array();
while ($row = mysqli_fetch_array($resultado)) {
  $colaboradores[] = $row;
}
$key_colabora = count($colaboradores);

//ADMINISTRADOR
$query1 = "SELECT * FROM colaborador WHERE nivel_acesso = '1' ";
$resultado1 = mysqli_query($conn, $query1);

$adm = array();
while ($row = mysqli_fetch_array($resultado1)) {
  $adm[] = $row;
}

$key_adm = $adm ? count($adm): "0";







    // $usuarios = mysqli_fetch_assoc($users);
    // foreach ($usuarios as $key => $user) {
    //   $colaboradores[] = $user;
    // }
    // var_dump($colaboradores);
    // $nome = $usuarios['nome'];
    // $matricula = $usuarios['matricula'];
    // $entrada = $usuarios['entrada'];
    // $saida = $usuarios['saida'];
    // $data_criacao = $usuarios['data_criacao'];
    // $data_atualizacao = $usuarios['data_atualizacao'];
    // $deletado_em = $usuarios['deletado_em'];
    // $nivel_acesso = $usuarios['nivel_acesso'];
    // if ($nivel_acesso == 1) {
    //     $nivel_acesso == 'colaborador';
    // }

  // } else {
  //   header("Location: ../index.html");
  // }


// 

?>



