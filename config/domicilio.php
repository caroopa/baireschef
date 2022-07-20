<?php 
  if(isset($_POST["btn-enviar-direccion"])) {
		$calle = $_POST["calle"];
		$numero = $_POST["numero"];
		$piso = $_POST["piso"];
		$localidad = $_POST["localidad"];
		$calles = $_POST["calles"];
		
		$domicilio = "Dirección: <br>".$calle." ".$numero." ".$piso." (".$localidad.")";
		$domicilio .= ".Entre calles ".$calles;
	}
	else {
		$domicilio = "Es sin envío a domicilio.";
	}
	$_SESSION["CARRITO"]["DOMICILIO"] = $domicilio;
?>	