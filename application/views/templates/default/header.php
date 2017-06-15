<?php $user = session_get_superadmin();?>

<header id="header" class="colored flat-menu darken-top-border">
	<div class="container-fluid" style="height:35px;background-color:#f2f2f2;">
		<div class="row">
			<div class="col-md-6">
			</div>
			<div class="col-md-6">
				<span> Conectado como <?php echo $user_name ?> - <?php echo $role ?>  | Mi perfil | <a href="<?php echo base_url("desconectar")?>">Desconectar</a></span>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
				<h1 class="logo pb-xs pt-none" style="margin-bottom:0px;">
					<a href="#"> <img alt="logo" width="278" height="102"
						data-sticky-width="200" data-sticky-height="70"
						data-sticky-padding="33"
						src="https://intranet.zitelia.com/imputaciones/public/img/logo.png">
					</a>
				</h1>
			</div>
			<div class="col-sm-6">
			</div>
			<div class="col-sm-4">
				<div class="siguiente pedido" style="margin-top:18px;">
					<p style="text-align:center">Siguiente pedido: <?php echo $date_next_order ?> hora</p>
				</div>
			</div>
		</div>
	</div>	
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">MENÚ</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <?php if ($role=="SuperAdmin"){?>
        <li><a href="#">Grupos</a></li>
        <li><a href="#">Bares</a></li>
        <li><a href="#">Usuarios</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Proveedores</a></li>
        <li><a href="#">Pedidos</a></li>
        <li><a href="#">Planificación</a></li>
      <?php } ?>
      <?php if ($role=="AdminGrupo"){?>
        <li><a href="#">Bares</a></li>
        <li><a href="#">Usuarios</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Proveedores</a></li>
        <li><a href="#">Planificación</a></li>
        <!-- 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        -->
      <?php } ?>
      <?php if ($role=="Propietario"){?>
        <li><a href="#">Bar</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Pedido actual</a></li>
            <li><a href="#">Pedidos anteriores</a></li>
          </ul>
        </li>
        <li><a href="#">Plantillas</a></li>
        <li><a href="<?php echo base_url("planificaciones")?>">Planificación</a></li>
      <?php } ?>
      <?php if ($role=="Empleado"){?>
        <li><a href="#">Nuevo pedido</a></li>
        <li><a href="#">Plantillas</a></li>
        <li><a href="#">Planificación</a></li>
      <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
</header>