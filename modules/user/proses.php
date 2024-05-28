<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}

else {

	if ($_GET['act']=='insert') {
		if (isset($_POST['Guardar'])) {
	
			$nombre  = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
			$apellido_paterno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_paterno']));
			$apellido_materno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_materno']));
			$correo  = mysqli_real_escape_string($mysqli, trim($_POST['correo']));
			$celular  = intval(trim($_POST['celular']));
			$direccion  = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
			$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
			$rol_id  = intval(trim($_POST['rol_id']));

			$query = mysqli_query($mysqli, "INSERT INTO usuarios(nombre,apellido_paterno,apellido_materno,correo,celular,direccion,password,rol_id,estado)
																			VALUES('$nombre','$apellido_paterno','$apellido_materno','$correo','$celular','$direccion','$password','$rol_id',1)")
																			or die('error: '.mysqli_error($mysqli));
          
			if ($query) {
					header("location: ../../main.php?module=user&alert=1");
			}
		}	
	}
	
	elseif ($_GET['act']=='update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {
				$id            = mysqli_real_escape_string($mysqli, trim($_POST['id']));
				$nombre           = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
				$apellido_paterno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_paterno']));
				$apellido_materno  = mysqli_real_escape_string($mysqli, trim($_POST['apellido_materno']));
				$correo  = mysqli_real_escape_string($mysqli, trim($_POST['correo']));
				$celular  = intval(trim($_POST['celular']));
				$direccion  = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
				$rol_id  = intval(trim($_POST['rol_id']));
					
				$query = mysqli_query($mysqli, "UPDATE usuarios SET 
																					nombre 	= '$nombre',
																					apellido_paterno = '$apellido_paterno',
																					apellido_materno = '$apellido_materno',
																					correo 	= '$correo',
																					celular       = '$celular',
																					direccion     = '$direccion',
																					rol_id   = '$rol_id'
																				WHERE id 	= '$id'")
																				or die('error: '.mysqli_error($mysqli));
                
				if ($query) {
			
						header("location: ../../main.php?module=user&alert=2");
				}

			}
		}
	}


	elseif ($_GET['act']=='on') {
		if (isset($_GET['id'])) {
			
			$id = $_GET['id'];
			$status  = 0;

		
            $query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id'")
                                            or die('error: '.mysqli_error($mysqli));

  
            if ($query) {
               
                header("location: ../../main.php?module=user&alert=3");
            }
		}
	}


	elseif ($_GET['act']=='off') {
		if (isset($_GET['id'])) {
			
			$id = $_GET['id'];
			$status  = 1;

		
            $query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id'")
                                            or die('Error : '.mysqli_error($mysqli));

        
            if ($query) {
              
                header("location: ../../main.php?module=user&alert=4");
            }
		}
	}		
}		
?>