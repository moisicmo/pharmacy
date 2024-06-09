<script type="text/javascript">
  function select_product_and_sucursal() {
    var product_id = document.getElementById('product_select').value;
    var sucursal_id = document.getElementById('sucursal_select').value;

    $.post("modules/medicines_transaction/medicines.php", {
      product_id: product_id,
      sucursal_id: sucursal_id,
    }, function(response) {
      $('#stok').html(response);
      document.getElementById('jumlah_masuk').focus();
      hitung_total_stok();
    });
  }

  function cek_jumlah_masuk(input) {
    var jml = input.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
      alert('¡La cantidad no puede ser cero!');
      input.value = input.value.substring(0, input.value.length - 1);
    }
  }

  function hitung_total_stok() {
    var bil1 = document.formObatMasuk.stok.value;
    var bil2 = document.formObatMasuk.jumlah_masuk.value;
    if (bil2 === "") {
      var hasil = "";
    } else {
      var hasil = eval(bil1) + eval(bil2);
    }

    document.formObatMasuk.total_stok.value = hasil;
  }
</script>

<?php
if ($_GET['form'] == 'add') { ?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Recepción de medicamentos
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
          <form role="form" class="form-horizontal" action="modules/medicines_transaction/proses.php?act=insert" method="POST" name="formObatMasuk">
            <div class="box-body">

              <div class="form-group">
                <label class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="fecha_a" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>

              <hr>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sucursal</label>
                <div class="col-sm-5">
                  <select class="chosen-select" id="sucursal_select" name="sucursal_id" data-placeholder="-- Seleccionar Sucursal --" onchange="select_product_and_sucursal()" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_sucursal = mysqli_query($mysqli, "SELECT * FROM sucursales ORDER BY nombre ASC") or die('error ' . mysqli_error($mysqli));
                    while ($data_sucursal = mysqli_fetch_assoc($query_sucursal)) {
                      echo "<option value=\"$data_sucursal[id]\"> $data_sucursal[nombre] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Medicamento</label>
                <div class="col-sm-5">
                  <select class="chosen-select" id="product_select" name="product_id" data-placeholder="-- Seleccionar Medicamento --" onchange="select_product_and_sucursal()" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_product = mysqli_query($mysqli, "SELECT * FROM productos ORDER BY id ASC") or die('error ' . mysqli_error($mysqli));
                    while ($data_product = mysqli_fetch_assoc($query_product)) {
                      echo "<option value=\"$data_product[id]\"> $data_product[cod_productos] | $data_product[nombre] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Proveedor</label>
                <div class="col-sm-5">
                  <select class="chosen-select" id="proveedor_select" name="proveedor_id" data-placeholder="-- Seleccionar Proveedor --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_product = mysqli_query($mysqli, "SELECT * FROM proveedor ORDER BY id ASC") or die('error ' . mysqli_error($mysqli));
                    while ($data_product = mysqli_fetch_assoc($query_product)) {
                      echo "<option value=\"$data_product[id]\"> $data_product[nombre] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <span id='stok'>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Stock</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="stok" name="stok" readonly required>
                  </div>
                </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_stok(this); cek_jumlah_masuk(this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Total Stock</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_stok" name="total_stok" readonly required>
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