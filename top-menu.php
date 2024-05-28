
<?php  

require_once "config/database.php";


$query = mysqli_query($mysqli, "SELECT u.id, u.nombre, r.nombre as 'permisos_acceso' FROM usuarios u INNER JOIN roles r ON r.id = u.rol_id  WHERE u.id='$_SESSION[id]'")
                                or die('error: '.mysqli_error($mysqli));


$data = mysqli_fetch_assoc($query);
?>

<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 
    <span class="hidden-xs"><?php echo $data['nombre']; ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>
  </a>
  <ul class="dropdown-menu">

    <li class="user-header">

      <p>
        <?php echo $data['nombre']; ?>
        <small><?php echo $data['permisos_acceso']; ?></small>
      </p>
    </li>
    
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a style="width:80px" href="?module=profile" class="btn btn-default btn-flat">Perfil</a>
      </div>

      <div class="pull-right">
        <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Salir</a>
      </div>
    </li>
  </ul>
</li>