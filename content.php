<?php
require_once "config/database.php";
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

$mensaje = "EL NOMBRE ES " . $_SESSION['nombre'];
echo "<script>console.log('" . addslashes($mensaje) . "');</script>";

if (empty($_SESSION['nombre']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
	if ($_GET['module'] == 'start') {
		include "modules/start/view.php";
	}
	//productos
	elseif ($_GET['module'] == 'medicines') {
		include "modules/medicines/view.php";
	} elseif ($_GET['module'] == 'form_medicines') {
		include "modules/medicines/form.php";
	//modulo movimientos
	} elseif ($_GET['module'] == 'medicines_transaction') {
		include "modules/medicines_transaction/view.php";
	} elseif ($_GET['module'] == 'form_medicines_transaction') {
		include "modules/medicines_transaction/form.php";
	}
	//modulo punto de venta
	elseif ($_GET['module'] == 'punto_venta') {
		include "modules/punto_venta/view.php";
	} elseif ($_GET['module'] == 'form_punto_venta') {
		include "modules/punto_venta/form.php";
	}
	//modulo usuarios
	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	} elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}
	//modulo sucursales
	elseif ($_GET['module'] == 'sucursales') {
		include "modules/sucursales/view.php";
	} elseif ($_GET['module'] == 'form_sucursal') {
		include "modules/sucursales/form.php";
	}
	//modulo sub categorias
	elseif ($_GET['module'] == 'sub_categorias') {
		include "modules/sub_categorias/view.php";
	}
	elseif ($_GET['module'] == 'form_sub_categorias') {
		include "modules/sub_categorias/form.php";
	}
	//clientes
	elseif ($_GET['module'] == 'clientes') {
		include "modules/clientes/view.php";
	} elseif ($_GET['module'] == 'form_clientes') {
		include "modules/clientes/form.php";
	}
	//roles
	elseif ($_GET['module'] == 'roles') {
		include "modules/roles/view.php";
	} elseif ($_GET['module'] == 'form_roles') {
		include "modules/roles/form.php";
	}
	//categorias
	elseif ($_GET['module'] == 'categorias') {
		include "modules/categorias/view.php";
	} elseif ($_GET['module'] == 'form_categorias') {
		include "modules/categorias/form.php";
	}
	//perfil
	elseif ($_GET['module'] == 'profile') {
		include "modules/profile/view.php";
	} elseif ($_GET['module'] == 'form_profile') {
		include "modules/profile/form.php";
	} elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
	//reporte
	elseif ($_GET['module'] == 'stock_inventory') {
		include "modules/stock_inventory/view.php";
	} elseif ($_GET['module'] == 'stock_report') {
		include "modules/stock_report/view.php";
	}
}
?>