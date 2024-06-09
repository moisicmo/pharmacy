<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Movimientos

    <a class="btn btn-primary btn-social pull-right" href="?module=form_medicines_transaction&form=add" title="Agregar" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Recepción
    </a>
  </h1>
</section>

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
              Datos de medicamentos han sido registrado correctamente.
            </div>";
      }
      ?>

      <div class="box box-primary">
        <div class="box-body">

          <!-- Acordeón -->
          <div class="panel-group" id="accordion">

            <?php
            $query_sucursales = "SELECT * FROM sucursales";
            $result_sucursales = $mysqli->query($query_sucursales);
            // Generar elementos del acordeón para cada sucursal

            if ($result_sucursales->num_rows > 0) {
              while ($row = $result_sucursales->fetch_assoc()) {
                echo "Sucursal ID: " . $row['id'] . " - Nombre: " . $row['nombre'] . "<br>";

                $sucursal_id = $row['id'];
                $sucursal_nombre = $row['nombre'];
            ?>

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSucursal<?php echo $sucursal_id; ?>">
                        <?php echo $sucursal_nombre; ?>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseSucursal<?php echo $sucursal_id; ?>" class="panel-collapse collapse">
                    <div class="panel-body">
                      <!-- Tabla para los movimientos de medicamentos -->
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th class="center">Nombre</th>
                            <th class="center">Stock</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Consulta para obtener los movimientos de medicamentos de la sucursal actual
                          $query_movimientos = "SELECT 
                                                p.nombre as prod_nombre,
                                                p.cod_productos,
                                                p.id as prod_id,
                                                su.nombre as suc_nombre,
                                                k.productos_id,
                                                k.id,
                                                venta_o_compra,
                                                id_venta_compra,
                                                stock
                                              FROM (
                                                  SELECT 
                                                    id,
                                                      productos_id,
                                                      sucursal_id,
                                                      venta_o_compra,
                                                      id_venta_compra,
                                                      stock,
                                                      ROW_NUMBER() OVER (PARTITION BY productos_id, sucursal_id ORDER BY id DESC) as rn
                                                  FROM 
                                                      kardex
                                              ) k
                                              INNER JOIN productos p ON p.id = k.productos_id
                                              INNER JOIN sucursales su ON su.id = k.sucursal_id
                                              WHERE 
                                                  rn = 1
                                                  and k.sucursal_id = $sucursal_id";
                          $result_movimientos = $mysqli->query($query_movimientos);

                          if ($result_movimientos->num_rows > 0) {
                            while ($data = $result_movimientos->fetch_assoc()) {
                              $producto_id = $data['productos_id'];
                              echo "<tr>
                                      <td class='center'>
                                      <a data-toggle='collapse' href='#collapseProducto{$producto_id}Sucursal{$sucursal_id}'>" . $data['cod_productos'] . " " . $data['prod_nombre'] . "</a>
                                      </td>
                                      <td class='center'>{$data['stock']}</td>
                                    </tr>";
                              echo "<tr id='collapseProducto{$producto_id}Sucursal{$sucursal_id}' class='panel-collapse collapse'>
                                      <td colspan='2'>
                                        <table class='table table-bordered table-striped table-hover'>
                                          <thead>
                                            <tr>
                                              <th class='center'>Fecha</th>
                                              <th class='center'>Tipo</th>
                                              <th class='center'>Cantidad</th>
                                            </tr>
                                          </thead>
                                          <tbody>";
                              // Consulta para obtener los movimientos específicos del producto
                              $query_detalle_movimientos = "SELECT
                                                            k.venta_o_compra,
                                                            IF(k.venta_o_compra = 'venta', v.cantidad, c.cantidad) AS cantidad,
                                                            IF(k.venta_o_compra = 'venta', f.fecha_emision, c.fecha) AS fecha
                                                              FROM kardex k
                                                              LEFT JOIN ventas v ON k.id_venta_compra = v.id AND k.venta_o_compra = 'venta'
                                                              LEFT JOIN compras c ON k.id_venta_compra = c.id AND k.venta_o_compra = 'compra'
                                                              LEFT JOIN facturas f ON v.factura_id = f.id
                                                              WHERE k.productos_id = $producto_id AND k.sucursal_id = $sucursal_id
                                                              ORDER BY fecha ASC";
                              $result_detalle_movimientos = $mysqli->query($query_detalle_movimientos);

                              if ($result_detalle_movimientos->num_rows > 0) {
                                while ($detalle = $result_detalle_movimientos->fetch_assoc()) {
                                  echo "<tr>
                                          <td class='center'>{$detalle['fecha']}</td>
                                          <td class='center'>{$detalle['venta_o_compra']}</td>
                                          <td class='center'>{$detalle['cantidad']}</td>
                                        </tr>";
                                }
                              } else {
                                echo "<tr><td colspan='3' class='center'>No hay movimientos disponibles</td></tr>";
                              }
                              echo "            </tbody>
                                        </table>
                                      </td>
                                    </tr>";
                            }
                          } else {
                            echo "<tr><td colspan='2' class='center'>No hay datos disponibles</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

            <?php
              }
            } else {
              echo "<p>No hay sucursales disponibles</p>";
            }
            ?>

          </div><!-- /.panel-group -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div> <!-- /.row -->
</section><!-- /.content -->