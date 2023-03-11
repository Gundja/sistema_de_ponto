<?php
session_start();

include_once('db.php');

$matricula = $_POST['matricula'];
$senha = $_POST['senha'];
    $query = "SELECT * FROM colaborador WHERE matricula='$matricula' AND senha='$senha'";
    $result = $conn->query($query);
    $dados = mysqli_fetch_assoc($result);
    $nivel = $dados['nivel_acesso'];

    if ($nivel == 1) {
        if ($result->num_rows > 0) {
            $_SESSION['matricula'] = $matricula;
            header("Location: ../index.php");
        } else {
            echo "Usuário ou senha inválidos.";
        }
    }elseif ($nivel == 0) {
        if ($result->num_rows > 0) {
            $_SESSION['matricula'] = $matricula;
            header("Location: ../home.php");
        } else {
            echo "Usuário ou senha inválidos.";
        }
    }
    
$conn->close();
?>