<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Punto de venta

    <a class="btn btn-primary btn-social pull-right btn-agregar-carrito" href="#" title="Agregar al carrito" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Carrito
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

          <!-- <input type="hidden" id="productosSeleccionados" name="productosSeleccionados"> -->

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
                            <th class="center">Precio</th>
                            <th class="center">Stock</th>
                            <th class="center">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>


                          <?php
                          $productos = array();
                          // Consulta para obtener los movimientos de medicamentos de la sucursal actual
                          $query_movimientos = "SELECT 
                          p.nombre as prod_nombre,
                          p.cod_productos,
                          p.precio,
                          p.id as prod_id,
                          su.nombre as suc_nombre,
                          su.id as suc_id,
                          k.productos_id,
                          k.id,
                          venta_o_compra,
                          id_venta_compra,
                          k.sucursal_id,
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
                              $productos[] = $data;
                              $producto_id = $data['productos_id'];
                              echo "<tr>
                                        <td class='center'>
                                            {" . $data['cod_productos'] . " " . $data['prod_nombre'] . "}
                                        </td>
                                        <td class='center'> " . $data['precio'] . " Bs </td>
                                        <td class='center'>" . $data['stock'] . "</td>
                                        <td class='center' width='100'>
                                            <div>
                                                <button data-producto-id='$producto_id' class='btn btn-primary btn-sm btn-sumar'>
                                                    <i style='color:#fff' class='fa fa-plus'></i>
                                                </button>
                                                <span class='cantidad'>0</span>
                                                <button data-producto-id='$producto_id' class='btn btn-primary btn-sm btn-restar'>
                                                    <i style='color:#fff' class='fa fa-minus'></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class='center' style='display: none;'>" . $sucursal_id . "</td>
                                    </tr>";
                            }
                          } else {
                            echo "<tr><td colspan='3' class='center'>No hay datos disponibles</td></tr>";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Objeto para almacenar los productos seleccionados
    var productosSeleccionados = [];

    // Función para actualizar la cantidad de un producto en productosSeleccionados
    function actualizarProductosSeleccionados(producto) {
      // Buscar si el producto ya está en productosSeleccionados
      var index = productosSeleccionados.findIndex(function(item) {
        return item.prod_id === producto.prod_id && item.sucursal_id === producto.sucursal_id;
      });

      // Si el producto ya está en la lista, actualizar su cantidad
      if (index !== -1) {
        productosSeleccionados[index].cantidad = producto.cantidad;
      } else {
        // Si el producto no está en la lista, agregarlo
        productosSeleccionados.push(producto);
      }

      // Filtrar productos con cantidad 0
      productosSeleccionados = productosSeleccionados.filter(function(item) {
        return item.cantidad > 0;
      });

      // Actualizar el campo oculto con los productos seleccionados
      $("#productosSeleccionados").val(JSON.stringify(productosSeleccionados));
    }

    // Manejar clic en el botón "Sumar"
    $(".btn-sumar").click(function() {
      var cantidad = parseInt($(this).siblings(".cantidad").text());
      var stock = parseInt($(this).closest("tr").find("td:eq(2)").text());
      if (cantidad < stock) {
        cantidad++;
        $(this).siblings(".cantidad").text(cantidad);

        var producto = {
          prod_nombre: $(this).closest("tr").find("td:eq(0)").text(),
          cod_productos: $(this).closest("tr").find("td:eq(0)").text().trim(),
          precio: parseFloat($(this).closest("tr").find("td:eq(1)").text().split(' ')[1]), // Separar el precio y eliminar "Bs"
          prod_id: $(this).data("producto-id"),
          sucursal_id: parseInt($(this).closest("tr").find("td:eq(4)").text()), // Asegúrate de que el índice coincida con la columna oculta
          cantidad: cantidad
        };
        actualizarProductosSeleccionados(producto);
      }
    });

    // Manejar clic en el botón "Restar"
    $(".btn-restar").click(function() {
      var cantidad = parseInt($(this).siblings(".cantidad").text());
      if (cantidad > 0) {
        cantidad--;
        $(this).siblings(".cantidad").text(cantidad);

        var producto = {
          prod_nombre: $(this).closest("tr").find("td:eq(0)").text(),
          cod_productos: $(this).closest("tr").find("td:eq(0)").text().trim(),
          precio: parseFloat($(this).closest("tr").find("td:eq(1)").text().split(' ')[1]), // Separar el precio y eliminar "Bs"
          prod_id: $(this).data("producto-id"),
          sucursal_id: parseInt($(this).closest("tr").find("td:eq(4)").text()), // Asegúrate de que el índice coincida con la columna oculta
          cantidad: cantidad
        };
        actualizarProductosSeleccionados(producto);
      }
    });

    $(".btn-agregar-carrito").click(function(event) {
      event.preventDefault();

      // Verifica los datos antes de enviarlos
      console.log("Productos Seleccionados antes de enviar:", productosSeleccionados);

      // Actualizar el campo oculto con los productos seleccionados
      var jsonString = JSON.stringify(productosSeleccionados);
      console.log("JSON String:", jsonString);

      // Crear un formulario y enviarlo
      var form = $('<form action="?module=form_punto_venta&form=add" method="post">' +
        '<input type="hidden" name="productosSeleccionados" value="' + jsonString.replace(/"/g, '&quot;') + '" />' +
        '</form>');
      $('body').append(form);
      form.submit();
    });
  });
</script>