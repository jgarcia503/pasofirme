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
          <i class="fa fa-weixin"></i>
          <span>Ganado</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="?mod=vanimales"><i class="fa white fa-paw"></i> Animales</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>