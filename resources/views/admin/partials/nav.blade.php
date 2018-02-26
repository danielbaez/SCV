<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <li class="{{ setActiveRoute('admin.dashboard') }}">
    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
  </li>
  <li class="treeview {{ setActiveRoute(['admin.configurations.index', 'admin.vouchers.index']) }}">
    <a href="#"><i class="fa fa-wrench"></i> <span>Configuración</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.configurations.index') }}">
        <a href="{{ route('admin.configurations.index') }}"><i class="fa fa-wrench"></i> Configuración</a>
      </li>
      <li class="{{ setActiveRoute('admin.vouchers.index') }}">
        <a href="{{ route('admin.vouchers.index') }}"><i class="fa fa-book"></i> Comprobantes</a>
      </li>     
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute(['admin.users.index', 'admin.roles.index']) }}">
    <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li class="{{ setActiveRoute('admin.roles.index') }}">
        <a href="{{ route('admin.roles.index') }}"><i class="fa fa-user"></i> Roles</a>
      </li>
      <li class="">
        <a href="{{ route('admin.users.create') }}"><i class="fa fa-eye"></i> Permisos</a>
      </li>  
    </ul>
  </li>  

</ul>