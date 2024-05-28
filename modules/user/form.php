

<?php  

if ($_GET['form']=='add') { ?>

  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Agregar Usuario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
      <li><a href="?module=user"> Usuario </a></li>
      <li class="active"> agregar </li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses.php?act=insert" enctype="multipart/form-data">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nombre" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Apellido Paterno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellido_paterno" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Apellido Materno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellido_materno" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Correo</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" name="correo"  required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Celular</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="celular" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="direccion"required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="password"required>
                </div>
              </div>

              <?php  
              $query = mysqli_query($mysqli, "SELECT * FROM roles") or die('error: '.mysqli_error($mysqli));
              ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Rol</label>
                <div class="col-sm-5">
                  <select class="form-control" name="rol_id" required>
                    <option value=""></option>
                    <?php
                    // Iterar sobre los resultados de la consulta y generar las opciones
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div><!-- /.box body -->
            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}

elseif ($_GET['form']=='edit') { 
  	if (isset($_GET['id'])) {

      $query = mysqli_query($mysqli, "SELECT u.*, r.nombre as rol_nombre FROM usuarios u INNER JOIN roles r ON r.id = u.rol_id WHERE u.id='$_GET[id]'") 
                                      or die('error: '.mysqli_error($mysqli));
      $data  = mysqli_fetch_assoc($query);
  	}	
?>

  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Modificar datos de Usuario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="?module=user"> Usuario </a></li>
      <li class="active"> Modificar </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" method="POST" action="modules/user/proses.php?act=update" enctype="multipart/form-data">
            <div class="box-body">

              <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

              <div class="form-group">
                <label class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nombre" autocomplete="off" value="<?php echo $data['nombre']; ?>" required>
                </div>
              </div>

            
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellido paterno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellido_paterno" autocomplete="off" value="<?php echo $data['apellido_paterno']; ?>" required>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Apellido materno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="apellido_materno" autocomplete="off" value="<?php echo $data['apellido_materno']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Correo</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" name="correo" autocomplete="off" value="<?php echo $data['correo']; ?>">
                </div>
              </div>
            
              <div class="form-group">
                <label class="col-sm-2 control-label">Celular</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="celular" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="<?php echo $data['celular']; ?>">
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="direccion" autocomplete="off" value="<?php echo $data['direccion']; ?>">
                </div>
              </div>

              <?php  
              $query = mysqli_query($mysqli, "SELECT * FROM roles") or die('error: '.mysqli_error($mysqli));
              ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Rol</label>
                <div class="col-sm-5">
                <select class="form-control" name="rol_id" required>
                  <?php
                  // Iterar sobre los resultados de la consulta y generar las opciones
                  while ($row = mysqli_fetch_assoc($query)) {
                      // Verificar si el ID del rol es igual al ID del rol del usuario
                      $selected = ($row['id'] == $rolUsuarioID) ? 'selected' : '';
                      echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
                  }
                  ?>
                </select>
                </div>
              </div>
            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>