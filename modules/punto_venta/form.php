<?php
if ($_GET['form'] == 'add') {
  $productosSeleccionados = isset($_POST['productosSeleccionados']) ? json_decode($_POST['productosSeleccionados'], true) : [];
  $totalPagar = 0;
?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Carrito
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i> Inicio </a></li>
      <li><a href="?module=medicines_transaction"> Entrada </a></li>
      <li class="active"> Agregar </li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <form role="form" class="form-horizontal" action="modules/punto_venta/proses.php?act=insert" method="POST">
            <div class="box-body">

              <input type="hidden" id="productosSeleccionados" name="productosSeleccionados" value='<?php echo json_encode($productosSeleccionados); ?>'>

              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="fecha_emision" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Cliente</label>
                <div class="col-sm-5">
                  <select class="chosen-select" id="sucursal_select" name="cliente_id" data-placeholder="-- Seleccionar Cliente --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_sucursal = mysqli_query($mysqli, "SELECT * FROM clientes ORDER BY nombre ASC") or die('error ' . mysqli_error($mysqli));
                    while ($data_sucursal = mysqli_fetch_assoc($query_sucursal)) {
                      echo "<option value=\"$data_sucursal[id]\"> $data_sucursal[nombre] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Productos Seleccionados</label>
                <div class="col-sm-10">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!empty($productosSeleccionados)) {
                        foreach ($productosSeleccionados as $producto) {
                          $subtotal = $producto['cantidad'] * $producto['precio']; // Calcular el subtotal de cada producto
                          $totalPagar += $subtotal; // Sumar el subtotal al total a pagar
                          echo "<tr>
                                  <td>{$producto['prod_nombre']}</td>
                                  <td>{$producto['precio']} Bs.</td>
                                  <td>{$producto['cantidad']}</td>
                                  <td>$subtotal Bs.</td>
                                </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='5'>No hay productos seleccionados</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Total a pagar</label>
                <div class="col-sm-10">
                  <p><?php echo $totalPagar; ?> Bs.</p>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                  <a href="?module=medicines_transaction" class="btn btn-default btn-reset">Cancelar</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>