
/*
La tabla se llama CLIENTE  debe tener los campos: IDCLIENTE (AI), NOM (VARCHAR),RUTCLI (VARCHAR),DIRE (VARCHAR),FONO(VARCHAR)
*/



<?php
if (isset($_GET['term'])){
	# Conexión bbdd
    $con=@mysqli_connect("localhost", "root", "tuPassParaServer", "tuBaseDeDatos");

$return_arr = array();
/* Si logra conectar. */
if ($con)
{
	$fetch = mysqli_query($con,"SELECT * FROM CLIENTE where NOM like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50");

	/* Agrupa y mantiene la consulta.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$nom=$row['NOM'];
		$row_array['value'] = $row['NOM']." | ".$row['RUTCLI'];
		$row_array['nombre']=$row['NOM'];
		$row_array['rut']=$row['RUTCLI'];
		$row_array['direccion']=$row['DIRE'];
    $row_array['fono']=$row['FONO'];

		array_push($return_arr,$row_array);
    }
}

/* Cierra bbdd. */
mysqli_close($con);

/* Codifica en JSON. */
echo json_encode($return_arr);

}
?>
