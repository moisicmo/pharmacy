<?php
require_once "config/database.php";

$nombre = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['nombre'])))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

if (!ctype_alnum($nombre) OR !ctype_alnum($password)) {
    header("Location: index.php?alert=1");
} else {
    $query = mysqli_query($mysqli, "SELECT u.*, r.nombre as 'permisos_acceso' FROM usuarios u INNER JOIN roles r ON r.id = u.rol_id WHERE u.nombre='$nombre' AND u.password='$password' AND u.estado=1")
    or die('error'.mysqli_error($mysqli));
    $rows  = mysqli_num_rows($query);

    if ($rows > 0) {
        $data  = mysqli_fetch_assoc($query);

        session_start();
        $_SESSION['id']                 = $data['id'];
        $_SESSION['nombre']             = $data['nombre'];
        $_SESSION['password']           = $data['password'];
        $_SESSION['apellido_paterno']   = $data['apellido_paterno'];
        $_SESSION['apellido_materno']   = $data['apellido_materno'];
        $_SESSION['permisos_acceso']    = $data['permisos_acceso'];

        header("Location: main.php?module=start");
    } else {
        header("Location: index.php?alert=1");
    }
}
?>
