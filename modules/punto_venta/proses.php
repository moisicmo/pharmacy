<?php
session_start();

require_once "../../config/database.php";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
	if ($_GET['act'] == 'insert') {
		if (isset($_POST['Guardar'])) {
			// Obtener los datos del formulario
			$cliente_id = intval(trim($_POST['cliente_id']));
			$usuario_id = $_SESSION['id'];
			try {
				$fecha_nacimiento = new DateTime(trim($_POST['fecha_emision']));
				// Formateamos la fecha a un formato adecuado para la base de datos
				$fecha_emision_formateada = $fecha_nacimiento->format('Y-m-d');
			} catch (Exception $e) {
				// Manejo de errores si la fecha no es válida
				echo "La fecha de nacimiento no es válida: " . $e->getMessage();
				exit; // Salir del script si hay un error en la fecha
			}
			$sucursal_id = isset(array_shift(json_decode($_POST['productosSeleccionados'], true))['sucursal_id']);

			
			// Crear la factura
			$query_factura = mysqli_query($mysqli, "INSERT INTO facturas(cliente_id, usuario_id, fecha_emision, sucursal_id) VALUES ('$cliente_id', '$usuario_id', '$fecha_emision_formateada', '$sucursal_id')")
			or die('Error al insertar factura: ' . mysqli_error($mysqli));
			
			if ($query_factura) {
				// Obtener el ID de la factura recién insertada
				$factura_id = mysqli_insert_id($mysqli);
				echo "<script>console.log('creado!! " . $factura_id . "');</script>";
		
				// Inicializar la variable para el total de la factura
				$total_factura = 0;
		
				// Obtener los productos seleccionados del formulario
				$productosSeleccionados = isset($_POST['productosSeleccionados']) ? json_decode($_POST['productosSeleccionados'], true) : [];
		
				// Insertar cada venta asociada a la factura y calcular el subtotal
				foreach ($productosSeleccionados as $producto) {
						$producto_id = $producto['prod_id'];
						$cantidad = $producto['cantidad'];
						$precio = $producto['precio'];
		
						// Calcular el subtotal del producto
						$subtotal_producto = $cantidad * $precio;
		
						// Sumar al total de la factura
						$total_factura += $subtotal_producto;
		
						// Insertar la venta
						$query_venta = mysqli_query($mysqli, "INSERT INTO ventas(productos_id, cantidad, precio, factura_id) VALUES ('$producto_id', '$cantidad', '$precio', '$factura_id')")
								or die('Error al insertar venta: ' . mysqli_error($mysqli));
				}
		
				// Insertar en detalle_factura con el subtotal calculado
				$query_detalle_factura = mysqli_query($mysqli, "INSERT INTO detalle_factura(factura_id, nro_factura, sub_total, descuento, total_a_pagar) VALUES ('$factura_id', '$factura_id', '$total_factura', 0, '$total_factura')")
						or die('Error al insertar detalle de factura: ' . mysqli_error($mysqli));
		
				// Redirigir después de realizar las inserciones
				header("location: ../../main.php?module=punto_venta&alert=1");
		}
		}
	}
}
