<?php

if ($_SESSION['permisos_acceso'] == 'Super Admin') { ?>

  <ul class="sidebar-menu">
    <li class="header">MENU</li>

    <?php

    if ($_GET["module"] == "start") {
      $active_home = "active";
    } else {
      $active_home = "";
    }
    ?>
    <li class="<?php echo $active_home; ?>">
      <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
    </li>
    <?php

    if ($_GET["module"] == "medicines" || $_GET["module"] == "form_medicines") { ?>
      <li class="active">
        <a href="?module=medicines"><i class="fa fa-folder"></i> Medicamentos </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=medicines"><i class="fa fa-folder"></i> Datos de medicamentos </a>
      </li>
    <?php
    }

    //movimientos 
    if ($_GET["module"] == "medicines_transaction" || $_GET["module"] == "form_medicines_transaction") { ?>
      <li class="active">
        <a href="?module=medicines_transaction"><i class="fa fa-clone"></i> Movimientos </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=medicines_transaction"><i class="fa fa-clone"></i> Movimientos </a>
      </li>
    <?php
    }
    //punto de venta 
    if ($_GET["module"] == "punto_venta" || $_GET["module"] == "form_punto_venta") { ?>
      <li class="active">
        <a href="?module=punto_venta"><i class="fa fa-clone"></i> Punto de venta </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=punto_venta"><i class="fa fa-clone"></i> Punto de venta</a>
      </li>
    <?php
    }

    if ($_GET["module"] == "stock_inventory") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a>
          </li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos</a></li>
        </ul>
      </li>
    <?php
    } elseif ($_GET["module"] == "stock_report") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a>
          </li>
        </ul>
      </li>
    <?php
    } else { ?>
      <li class="treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a></li>
        </ul>
      </li>
    <?php
    }


    if ($_GET["module"] == "user" || $_GET["module"] == "form_user") { ?>
      <li class="active">
        <a href="?module=user"><i class="fa fa-user"></i> Administrar usuarios</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=user"><i class="fa fa-user"></i> Administrar usuarios</a>
      </li>
    <?php
    }

    //clientes
    if ($_GET["module"] == "clientes" || $_GET["module"] == "form_clientes") { ?>
      <li class="active">
        <a href="?module=clientes"><i class="fa fa-users"></i> clientes</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=clientes"><i class="fa fa-users"></i> clientes</a>
      </li>
    <?php
    }
    //sucursales
    if ($_GET["module"] == "user" || $_GET["module"] == "form_user") { ?>
      <li class="active">
        <a href="?module=sucursales"><i class="fa fa-user"></i> sucursales</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=sucursales"><i class="fa fa-user"></i> sucursales</a>
      </li>
    <?php
    }
    //categorias
    if ($_GET["module"] == "categorias" || $_GET["module"] == "form_categorias") { ?>
      <li class="active">
        <a href="?module=categorias"><i class="fa fa-user"></i> categorias</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=categorias"><i class="fa fa-user"></i> categorias</a>
      </li>
    <?php
    }
    //sub_categorias
    if ($_GET["module"] == "sub_categorias" || $_GET["module"] == "form_sub_categorias") { ?>
      <li class="active">
        <a href="?module=sub_categorias"><i class="fa fa-heartbeat"></i> sub_categorias</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=sub_categorias"><i class="fa fa-heartbeat"></i> sub_categorias</a>
      </li>
    <?php
    }

    //roles
    if ($_GET["module"] == "roles" || $_GET["module"] == "form_roles") { ?>
      <li class="active">
        <a href="?module=roles"><i class="fa fa-user"></i> roles</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=roles"><i class="fa fa-user"></i> roles</a>
      </li>
    <?php
    }


    if ($_GET["module"] == "password") { ?>
      <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    }
    ?>
  </ul>

<?php
} elseif ($_SESSION['permisos_acceso'] == 'Gerente') { ?>
  <!-- sidebar menu start -->
  <ul class="sidebar-menu">
    <li class="header">MENU</li>

    <?php

    if ($_GET["module"] == "start") { ?>
      <li class="active">
        <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
    <?php
    }


    if ($_GET["module"] == "stock_inventory") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos</a></li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a></li>
        </ul>
      </li>
    <?php
    } elseif ($_GET["module"] == "stock_report") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a>
          </li>
        </ul>
      </li>
    <?php
    } else { ?>
      <li class="treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a></li>
        </ul>
      </li>
    <?php
    }

    if ($_GET["module"] == "password") { ?>
      <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    }
    ?>
  </ul>
<?php
}
if ($_SESSION['permisos_acceso'] == 'Almacen') { ?>

  <ul class="sidebar-menu">
    <li class="header">MENU</li>

    <?php

    if ($_GET["module"] == "start") { ?>
      <li class="active">
        <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=start"><i class="fa fa-home"></i> Inicio </a>
      </li>
    <?php
    }

    if ($_GET["module"] == "medicines" || $_GET["module"] == "form_medicines") { ?>
      <li class="active">
        <a href="?module=medicines"><i class="fa fa-folder"></i> Datos de medicamentos </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=medicines"><i class="fa fa-folder"></i> Datos de medicamentos </a>
      </li>
    <?php
    }

    if ($_GET["module"] == "medicines_transaction" || $_GET["module"] == "form_medicines_transaction") { ?>
      <li class="active">
        <a href="?module=medicines_transaction"><i class="fa fa-clone"></i> Registro de medicamentos </a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=medicines_transaction"><i class="fa fa-clone"></i> Registro de medicamentos </a>
      </li>
    <?php
    }

    if ($_GET["module"] == "stock_inventory") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a>
          </li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a></li>
        </ul>
      </li>
    <?php
    } elseif ($_GET["module"] == "stock_report") { ?>
      <li class="active treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li class="active"><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a>
          </li>
        </ul>
      </li>
    <?php
    } else { ?>
      <li class="treeview">
        <a href="javascript:void(0);">
          <i class="fa fa-file-text"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?module=stock_inventory"><i class="fa fa-circle-o"></i> Stock de Medicamentos </a></li>
          <li><a href="?module=stock_report"><i class="fa fa-circle-o"></i> Registro de medicamentos </a></li>
        </ul>
      </li>
    <?php
    }

    if ($_GET["module"] == "password") { ?>
      <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    } else { ?>
      <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
      </li>
    <?php
    }
    ?>
  </ul>
<?php
}
?>