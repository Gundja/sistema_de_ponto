<?php
session_start();

    include_once('db.php');
    $matricula = $_SESSION['matricula'];

    if(isset($_POST['marcar'])){
        $tipo = $_POST['tipo'];
        $data_marcacao = date('Y/m/d');
        
       $sql = "INSERT INTO ponto (fk_colaborador, tipo, data_marcacao) VALUES ('".$matricula."', '".$tipo."', '".$data_marcacao."')";

        if (mysqli_query($conn, $sql)) {
                echo "Dados inseridos com sucesso";
                header("Location: ../home.php");
        } else {
                echo "Erro ao inserir dados: " . mysqli_error($conn);
        }
    }
 
    $query_ponto = "SELECT * FROM ponto WHERE fk_colaborador = '$matricula' ORDER BY id DESC LIMIT 1";
    $result_ponto = $conn->query($query_ponto);

    if ($result_ponto->num_rows > 0) {
        $row = $result_ponto->fetch_assoc();
        $tipo = $row['tipo'];  
    }
?>