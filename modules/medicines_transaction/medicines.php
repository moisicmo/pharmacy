
<?php
session_start();


require_once "../../config/database.php";

if (isset($_POST['product_id']) or isset($_POST['sucursal_id'])) {
  $product_id = $_POST['product_id'];
  $sucursal_id = $_POST['sucursal_id'];

  $query = mysqli_query($mysqli, "SELECT 
                                    p.nombre as prod_nombre,
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
                                      and k.sucursal_id = '$sucursal_id'
                                      and k.productos_id = '$product_id'")
    or die('error ' . mysqli_error($mysqli));


  $data = mysqli_fetch_assoc($query);

  $stock = isset($data['stock']) ? $data['stock'] : 0;
  $unidad = $data['unidad'];

  echo "<div class='form-group'>
    <label class='col-sm-2 control-label'>Stock</label>
    <div class='col-sm-5'>
      <div class='input-group'>
        <input type='text' class='form-control' id='stok' name='stock' value='$stock' readonly>
        <span class='input-group-addon'>$unidad</span>
      </div>
    </div>
  </div>";
}
?> 