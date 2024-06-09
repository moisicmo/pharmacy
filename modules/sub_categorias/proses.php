<?php
session_start();


require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

	if ($_GET['act'] == 'insert') {
		if (isset($_POST['Guardar'])) {

			$nombre = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));

			$query = mysqli_query($mysqli, "INSERT INTO sub_categorias(nombre) VALUES('$nombre')")
				or die('error: ' . mysqli_error($mysqli));

			if ($query) {
				header("location: ../../main.php?module=sub_categorias&alert=1");
			}
		}
	} elseif ($_GET['act'] == 'update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {
				$id = mysqli_real_escape_string($mysqli, trim($_POST['id']));

				$nombre = mysqli_real_escape_string($mysqli, trim($_POST['nombre']));

				$query = mysqli_query($mysqli, "UPDATE sub_categorias SET 
														nombre 	= '$nombre'
													WHERE id 	= '$id'")
					or die('error: ' . mysqli_error($mysqli));

				if ($query) {

					header("location: ../../main.php?module=sub_categorias&alert=2");
				}

			}
		}
	} 
}
?>