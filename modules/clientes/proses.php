<?php
session_start();

require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {

	if ($_GET['act']=='insert') {
		if (isset($_POST['Guardar'])) {
	
			$ci_nit  = mysqli_real_escape_string($mysqli, trim($_POST['ci_nit']));
			$nombre  = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
			$apellido_paterno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_paterno']));
			$apellido_materno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_materno']));
			$direccion  = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
			$celular  = intval(trim($_POST['celular']));
			$correo  = mysqli_real_escape_string($mysqli, trim($_POST['correo']));
			try {
				$fecha_nacimiento = new DateTime(trim($_POST['fecha_nacimiento']));
				// Formateamos la fecha a un formato adecuado para la base de datos
				$fecha_nacimiento_formateada = $fecha_nacimiento->format('Y-m-d');
			} catch (Exception $e) {
				// Manejo de errores si la fecha no es válida
				echo "La fecha de nacimiento no es válida: " . $e->getMessage();
				exit; // Salir del script si hay un error en la fecha
			}
			
			$razon_social  = mysqli_real_escape_string($mysqli, trim($_POST['razon_social']));

			$query = mysqli_query($mysqli, "INSERT INTO clientes(ci_nit,nombre,apellido_paterno,apellido_materno,direccion,celular,correo,fecha_nacimiento,razon_social)
																			VALUES('$ci_nit','$nombre','$apellido_paterno','$apellido_materno','$direccion','$celular','$correo','$fecha_nacimiento_formateada','$razon_social')")
																			or die('error: '.mysqli_error($mysqli));
          
			if ($query) {
					header("location: ../../main.php?module=clientes&alert=1");
			}
		}	 
	}
	
	elseif ($_GET['act']=='update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {
				$id            = intval(trim($_POST['id']));
				$ci_nit  = mysqli_real_escape_string($mysqli, trim($_POST['ci_nit']));
				$nombre           = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
				$apellido_paterno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_paterno']));
				$apellido_materno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_materno']));
				$direccion  = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
				$celular  = intval(trim($_POST['celular']));
				$correo  = mysqli_real_escape_string($mysqli, trim($_POST['correo']));
				try {
					$fecha_nacimiento = new DateTime(trim($_POST['fecha_nacimiento']));
					// Formateamos la fecha a un formato adecuado para la base de datos
					$fecha_nacimiento_formateada = $fecha_nacimiento->format('Y-m-d');
				} catch (Exception $e) {
					// Manejo de errores si la fecha no es válida
					echo "La fecha de nacimiento no es válida: " . $e->getMessage();
					exit; // Salir del script si hay un error en la fecha
				}
				$razon_social  = mysqli_real_escape_string($mysqli, trim($_POST['razon_social']));
					
				$query = mysqli_query($mysqli, "UPDATE clientes SET 
														ci_nit 	= '$ci_nit',
														nombre 	= '$nombre',
														apellido_paterno = '$apellido_paterno',
														apellido_materno = '$apellido_materno',
														direccion     = '$direccion',
														celular       = '$celular',
														correo 	= '$correo',
														fecha_nacimiento 	= '$fecha_nacimiento_formateada',
														razon_social 	= '$razon_social'
													WHERE id 	= '$id'")
													or die('error: '.mysqli_error($mysqli));
                
				if ($query) {
			
						header("location: ../../main.php?module=clientes&alert=2");
				}

			}
		}
	}
	
}		
?>