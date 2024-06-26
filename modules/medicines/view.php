<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Medicamentos

    <a class="btn btn-primary btn-social pull-right" href="?module=form_medicines&form=add" title="agregar" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Agregar
    </a>
  </h1>

</section>


<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  

    if (empty($_GET['alert'])) {
      echo "";
    } 
  
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Nuevos datos de medicamentos ha sido  almacenado correctamente.
            </div>";
    }

    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
             Datos del Medicamento modificados correcamente.
            </div>";
    }

    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
            Se eliminaron los datos del Medicamento
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
    
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
      
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Codigo</th>
                <th class="center">Nombre</th>
                <th class="center">Categoria</th>
                <th class="center">Sub Categoria</th>
                <!-- <th class="center">Precio de venta</th> -->
                <th class="center">Precio</th>
                <!-- <th class="center">Unidad</th> -->
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php  
            $no = 1;
            $query = mysqli_query($mysqli, "SELECT p.*, c.nombre as cat_nombre, s.nombre as sub_cat_nombre
                                            FROM productos p 
                                            INNER JOIN categorias c ON c.id=p.categoria_id
                                            INNER JOIN sub_categorias s ON s.id = p.sub_categoria_id
                                            ORDER BY p.id DESC")
                                            or die('error: '.mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query)) { 
              // $precio_compra = format_rupiah($data['precio_compra']);
              // $precio_venta = format_rupiah($data['precio_venta']);
              // <td width='100' align='right'>$ $precio_compra</td>
              // <td width='100' align='right'>$ $precio_venta</td>
              // <td width='80' class='center'>$data[unidad]</td>
           
              echo "<tr>
                      <td width='30' class='center'>$data[id]</td>
                      <td width='80' class='center'>$data[cod_productos]</td>
                      <td width='180'>$data[nombre]</td>
                      <td width='180'>$data[cat_nombre]</td>
                      <td width='180'>$data[sub_cat_nombre]</td>
                      <td width='80' align='right'>$data[precio] Bs</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='modificar' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_medicines&form=edit&id=$data[cod_productos]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
            ?>
                          <a data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm" href="modules/medicines/proses.php?act=delete&id=<?php echo $data['cod_productos'];?>" onclick="return confirm('estas seguro de eliminar<?php echo $data['nombre']; ?> ?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
            <?php
              echo "    </div>
                      </td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content