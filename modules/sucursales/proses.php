<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

	if ($_GET['act'] == 'insert') {
		if (isset($_POST['Guardar'])) {

			$nombre = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
			$direccion = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
			$telefono = intval(trim($_POST['telefono']));

			$query = mysqli_query($mysqli, "INSERT INTO sucursales(nombre,direccion,telefono)
																			VALUES('$nombre','$direccion','$telefono')")
				or die('error: ' . mysqli_error($mysqli));

			if ($query) {
				header("location: ../../main.php?module=sucursales&alert=1");
			}
		}
	} elseif ($_GET['act'] == 'update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {
				$id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
				$nombre = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));
				$direccion = mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
				$telefono = intval(trim($_POST['telefono']));

				$query = mysqli_query($mysqli, "UPDATE sucursales SET 
														nombre = '$nombre',
														direccion = '$direccion',
														telefono = '$telefono'
														WHERE id = '$id'")
					or die('error: ' . mysqli_error($mysqli));

				if ($query) {

					header("location: ../../main.php?module=sucursales&alert=2");
				}

			}
		}
	} elseif ($_GET['act'] == 'on') {
		if (isset($_GET['id'])) {

			$id = $_GET['id'];
			$status = 0;


			$query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id'")
				or die('error: ' . mysqli_error($mysqli));


			if ($query) {

				header("location: ../../main.php?module=user&alert=3");
			}
		}
	} elseif ($_GET['act'] == 'off') {
		if (isset($_GET['id'])) {

			$id = $_GET['id'];
			$status = 1;


			$query = mysqli_query($mysqli, "UPDATE usuarios SET estado  = '$status'
                                                          WHERE id = '$id'")
				or die('Error : ' . mysqli_error($mysqli));


			if ($query) {

				header("location: ../../main.php?module=user&alert=4");
			}
		}
	}
}
?>