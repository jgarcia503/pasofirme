<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="img/user_icon.png" style="background: #ffffff;" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo($_SESSION["nombre"]); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>&nbsp;En L&iacute;nea</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li><a href="?mod=inicio"><i class="fa fa-home"></i><span>&nbsp;Inicio</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-map-signs"></i> <span>Ganado</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-paw"></i> Animales <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="?mod=vanimales">Animales</a></li>
              <li><a href="?mod=razas">Razas</a></li>
              <li><a href="?mod=colores">Colores</a></li>
              <li><a href="?mod=grupos">Grupos</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-gg"></i> Producci&oacute;n <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="?mod=panimales">Peso de animales</a></li>
              <li><a href="?mod=peso_leche">Producci&oacute;n de leche</a></li>
              <li><a href="?mod=analisis_leche">An&aacute;lisis de leche</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-cubes"></i> Reproducci&oacute;n <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="?mod=servicios">Servicios</a></li>
              <li><a href="?mod=palpaciones">Palpaciones</a></li>
              <li><a href="?mod=respalpaciones">Resultado de palpacion</a></li>
              <li><a href="?mod=partos">Partos</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-alert"></i> Mortalidad <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="?mod=mortalidad">Mortalidad</a></li>
              <li><a href="#">Causa de mortalidad</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-list-alt"></i>
          <span>Proyectos</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?mod=siembra"><i class="ion ion-ios-nutrition"></i> Siembras</a></li>
          <li><a href="?mod=cosechas"><i class="fa fa-leaf"></i> Cosechas</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-male"></i>
          <span>Administrador</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?mod=hacienda"><i class="fa fa-map"></i> Hacienda</a></li>
          <li><a href="?mod=usuarios"><i class="fa fa-group"></i> Contactos</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>