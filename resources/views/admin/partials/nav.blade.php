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
      <li class="{{ setActiveRoute('admin.roles.index') }}">
        <a href="{{ route('admin.roles.index') }}"><i class="fa fa-user"></i> Roles</a>
      </li>
      <li class="">
        <a href="{{ route('admin.users.create') }}"><i class="fa fa-eye"></i> Permisos</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute(['admin.categories.index', 'admin.brands.index', 'admin.presentations.index', 'admin.products.index']) }}">
    <a href="#"><i class="fa fa-product-hunt"></i> <span>Almacén</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.categories.index') }}">
        <a href="{{ route('admin.categories.index') }}"><i class="fa fa-certificate"></i> Categorías</a>
      </li>
      <li class="{{ setActiveRoute('admin.brands.index') }}">
        <a href="{{ route('admin.brands.index') }}"><i class="fa fa-maxcdn"></i> Marcas</a>
      </li>
      <li class="{{ setActiveRoute('admin.presentations.index') }}">
        <a href="{{ route('admin.presentations.index') }}"><i class="fa fa-gift"></i> Presentaciones</a>
      </li>
      <li class="">
        <a href="{{ route('admin.products.index') }}"><i class="fa fa-product-hunt"></i> Productos</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute(['admin.categories.index']) }}">
    <a href="#"><i class="fa fa-product-hunt"></i> <span>Inventario</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.categories.index') }}">
        <a href="{{ route('admin.categories.index') }}"><i class="fa fa-certificate"></i> Kardex</a>
      </li>
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute(['admin.providers.index', 'admin.purchases.index', 'admin.purchases.create']) }}">
    <a href="#"><i class="fa fa-shopping-cart"></i> <span>Compras</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.providers.index') }}">
        <a href="{{ route('admin.providers.index') }}"><i class="fa fa-truck"></i> Proveedores</a>
      </li>
      <li class="{{ setActiveRoute(['admin.purchases.index', 'admin.purchases.create']) }}">
        <a href="{{ route('admin.purchases.index') }}"><i class="fa fa-shopping-cart"></i> Compras</a>
      </li>
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute(['admin.customers.index', 'admin.sales.index']) }}">
    <a href="#"><i class="fa fa-money"></i> <span>Ventas</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.customers.index') }}">
        <a href="{{ route('admin.customers.index') }}"><i class="fa fa-users"></i> Clientes</a>
      </li>
      <li class="{{ setActiveRoute('admin.sales.index') }}">
        <a href="{{ route('admin.sales.index') }}"><i class="fa fa-money"></i> Ventas</a>
      </li>
    </ul>
  </li>  

</ul>