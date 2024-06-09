<section class="content-header">
  <h1>
    <i class="fa fa-user icon-title"></i> sub_categorias

    <a class="btn btn-primary btn-social pull-right" href="?module=form_sub_categorias&form=add" title="Agregar"
      data-toggle="tooltip">
      <i class="fa fa-plus"></i> Agregar
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <?php

      if (empty($_GET['alert'])) {
        echo "";
      } elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
              Los nuevos datos de sub_categorias se ha registrado correcamente.
            </div>";
      } elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
           Los datos de sub_categorias ha sido cambiado satisfactoriamente.
            </div>";
      } elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
             Asegúrese de que el archivo que se sube es correcto.
            </div>";
      } elseif ($_GET['alert'] == 4) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
            Asegúrese de que la imagen no es más de 1 MB.
            </div>";
      } elseif ($_GET['alert'] == 5) {
        echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Error!</h4>
             Asegúrese de que el tipo de archivo subido sea  *.JPG, *.JPEG, *.PNG.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">

          <table id="dataTables1" class="table table-bordered table-striped table-hover">

            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Nombre</th>
                <th class="center"></th>
              </tr>
            </thead>


            <tbody>
              <?php

              $query = mysqli_query($mysqli, "SELECT *  FROM sub_categorias ORDER BY id DESC")
                or die('error: ' . mysqli_error($mysqli));
              while ($data = mysqli_fetch_assoc($query)) {

                echo "  <td>{$data['id']}</td>
                        <td>{$data['nombre']}</td>
                        <td class='center' width='100'>
                            <div>";

                echo "      <a data-toggle='tooltip' data-placement='top' title='Modificar' class='btn btn-primary btn-sm' href='?module=form_sub_categorias&form=edit&id={$data['id']}'>
                                <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                            </a>
                            </div>
                        </td>
                      </tr>";
              }

              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content