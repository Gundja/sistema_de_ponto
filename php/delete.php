<?php
include_once('db.php');
if (isset($_POST['apagar'])) {
	$matricula = $_POST['matricula'];
	$delete = "DELETE FROM colaborador WHERE matricula = $matricula ";
	if (mysqli_query($conn, $delete)) {
    	header("location: ../index.php");
	} else {
    	echo "Erro ao deletar registro: " . mysqli_error($conn);
	}
}
?>