<?php
include_once('db.php');

    $nome = $_POST['nome'];
    $entrada = $_POST['entrada'];
    $h_saida = $_POST['h_saida'];
    $data_criacao = $_POST['data_criacao'];
    $data_atualizacao = $_POST['data_atualizacao'];
    $senha = $_POST['senha'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $matricula = rand(7,1000);
    $matricula = str_pad($matricula, 5, "0", STR_PAD_LEFT);

    $sql = "INSERT INTO colaborador (nome, matricula, entrada, saida, data_atualizacao, data_criacao, senha, nivel_acesso) 
                VALUES (
                        '".$nome."', 
                        '".$matricula."', 
                        '".$entrada."', 
                        '".$h_saida."', 
                        '".$data_atualizacao."',
                        '".$data_criacao."',
                        '".$senha."',
                        '".$nivel_acesso."'
                        )";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
    } else {
            echo "Erro ao inserir dados: " . mysqli_error($conn);
    }
?>