<?php

//echo "<h1>Gerar Excel - csv</h1>";

// Aceitar csv ou texto 
header('Content-Type: text/csv; charset=utf-8');  

// Nome arquivo
header('Content-Disposition: attachment; filename=arquivo.csv');

// Gravar no buffer
$resultado = fopen("php://output", 'w');

// Criar o cabeçalho do Excel - Usar a função mb_convert_encoding para converter carateres especiais
$cabecalho = ['id', 'Nome', 'E-mail', mb_convert_encoding('Endereço', "ISO-8859-1", "UTF-8")];

// Array de dados
$usuarios = [
    [
        'id' => '1',
        'nome' => 'Cesar',
        'email' => 'cesar@celke.com.br',
        'endereco' => 'Rua ...',
    ],
    [
        'id' => '2',
        'nome' => 'Kelly',
        'email' => 'kelly@celke.com.br',
        'endereco' => 'Avenida ...',
    ],
    [
        'id' => '3',
        'nome' => mb_convert_encoding('Jéssica', "ISO-8859-1", "UTF-8"),
        'email' => 'jessica@celke.com.br',
        'endereco' => 'Rodovia ...',
    ],
    [
        'id' => '4',
        'nome' => 'Gabrielly',
        'email' => 'gabrielly@celke.com.br',
        'endereco' => 'Estrada ...',
    ],
];

// Abrir o arquivo
//$arquivo = fopen('file.csv', 'w');

// Escrever o cabeçalho no arquivo
fputcsv($resultado, $cabecalho, ';');

// Escrever o conteúdo no arquivo
foreach($usuarios as $row_usuario){
    fputcsv($resultado, $row_usuario, ';');
}

// Fechar arquivo
fclose($resultado);
