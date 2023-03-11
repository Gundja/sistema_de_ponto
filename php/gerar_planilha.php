<?php
include_once('db.php');
error_reporting(0);
        //planilha
      if (isset($_POST['planilha'])) {
            $matricula = $_POST['matricula'];

            $nivel = "SELECT * FROM colaborador WHERE matricula= '".$matricula."'";
            $user_lodado = mysqli_query($conn , $nivel);
            $usuario = mysqli_fetch_assoc($user_lodado);


            $nome_colabora = $usuario['nome'];
            $matricula_colabora = $usuario['matricula'];
            $entrada_colabora = $usuario['entrada'];
            $saida_colabora = $usuario['saida'];
            $periodo = substr($entrada_colabora, 0,2).":".substr($entrada_colabora, 2,2)." às ".substr($saida_colabora, 0,2).":".substr($saida_colabora, 2,2);

            $pontos = "SELECT DATE(data_marcacao), tipo, ponto, COUNT(*)  FROM ponto WHERE fk_colaborador= '".$matricula_colabora."' AND tipo = '1' GROUP BY DATE(data_marcacao) DESC";
            $ponto = mysqli_query($conn , $pontos);
            $marcacoes = array();
            while ($row = mysqli_fetch_array($ponto)) {
            $marcacoes_etrada[] = $row;
            }
            foreach ($marcacoes_etrada as $key => $entrada) {
                $entrou = isset($entrada[2]) ? $entrada[2] : '---';
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

            $cliee = "SELECT * FROM ponto WHERE fk_colaborador= '".$matricula_colabora."'";
            $clie = mysqli_query($conn , $cliee);
            $cliente = array();
            while ($row = mysqli_fetch_array($clie)) {
            $cliiiii[] = $row;
            }

            header('Content-Type: text/csv; charset=utf-8');  
            header('Content-Disposition: attachment; filename=folha_de_ponto.csv');
            $resultado = fopen("php://output", 'w');


            $cabecalho = ['NOME', 'MATRICULA', 'DATA', 'TURNO' ,mb_convert_encoding('TIPO DE MARCAÇÃO', "ISO-8859-1", "UTF-8"), mb_convert_encoding('HORA DA MARCAÇÃO', "ISO-8859-1", "UTF-8")];
            
            
            foreach ($cliiiii as $key => $marcacao) {
                
                if ($marcacao['tipo'] == '0') {
                    $marcou = 'Saída';
                }elseif ($marcacao['tipo'] == '1') {
                    $marcou = 'Entrada';
                }
                $usuarios[]= [
                    [
                        'nome' =>  mb_convert_encoding($nome_colabora, "ISO-8859-1", "UTF-8"),
                        'matricula' => $matricula_colabora,
                        'data_marcacao' => $marcacao['data_marcacao'],
                        'fuso-horario' =>  mb_convert_encoding($periodo, "ISO-8859-1", "UTF-8"),
                        'tipo_marcacao' =>  $marcou,
                        'hora_saiu' => $marcacao['ponto'],
                    ]
                ];

                
                foreach($usuarios as $row_usuario){
                    fputcsv($resultado, $cabecalho, ';');
                    foreach ($row_usuario as $key => $users) {
                        fputcsv($resultado, $users, ';');
                    }
                }

                fclose($resultado);
            }
      } 
   ?>