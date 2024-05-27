<?php
require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

if (!ctype_alnum($username) OR !ctype_alnum($password)) {
    header("Location: index.php?alert=1");
} else {
    $query = mysqli_query($mysqli, "SELECT u.*, r.nombre as 'permisos_acceso' FROM usuarios u INNER JOIN roles r ON r.id = u.rol_id WHERE u.nombre='$username' AND u.password='$password' AND u.estado=1")
    or die('error'.mysqli_error($mysqli));
    $rows  = mysqli_num_rows($query);

    if ($rows > 0) {
        $data  = mysqli_fetch_assoc($query);

        session_start();
        $_SESSION['id']                 = $data['id'];
        $_SESSION['nombre']             = $data['nombre'];
        $_SESSION['password']           = $data['password'];
        $_SESSION['apellido_paterno']   = $data['apellido_paterno'];
        $_SESSION['permisos_acceso']    = $data['permisos_acceso'];

        header("Location: main.php?module=start");
    } else {
        header("Location: index.php?alert=1");
    }
}
?>
