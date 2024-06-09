

<?php
session_start();

require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {

            // $fecha         = mysqli_real_escape_string($mysqli, trim($_POST['fecha_a']));

            try {
				$fecha_nacimiento = new DateTime(trim($_POST['fecha_a']));
				// Formateamos la fecha a un formato adecuado para la base de datos
				$fecha_formateada = $fecha_nacimiento->format('Y-m-d');
			} catch (Exception $e) {
				// Manejo de errores si la fecha no es válida
				echo "La fecha de nacimiento no es válida: " . $e->getMessage();
				exit; // Salir del script si hay un error en la fecha
			}
            $sucursal_id  = intval(trim($_POST['sucursal_id']));
            $product_id  = intval(trim($_POST['product_id']));
            $proveedor_id  = intval(trim($_POST['proveedor_id']));
            $cantidad  = intval(trim($_POST['jumlah_masuk']));
            echo "<script>console.log('proveedor_id " . addslashes($proveedor_id) . "');</script>";
            echo "<script>console.log('sucursal_id " . addslashes($sucursal_id) . "');</script>";
            echo "<script>console.log('product_id " . addslashes($product_id) . "');</script>";
            echo "<script>console.log('fecha_formateada " . addslashes($fecha_formateada) . "');</script>";
            echo "<script>console.log('cantidad " . addslashes($cantidad) . "');</script>";

            $query = mysqli_query($mysqli, "INSERT INTO compras(proveedor_id,sucurdal_id,producto_id,fecha,cantidad)
                                            VALUES('$proveedor_id','$sucursal_id','$product_id','$fecha_formateada','$cantidad')")
                or die('Error: ' . mysqli_error($mysqli));


            if ($query) {

                // $query1 = mysqli_query($mysqli, "UPDATE medicamentos SET stock        = '$total_stock'
                //                                               WHERE codigo   = '$codigo'")
                //     or die('Error: ' . mysqli_error($mysqli));


                // if ($query1) {

                    header("location: ../../main.php?module=medicines_transaction&alert=1");
                // }
            }
        }
    }
}
?>