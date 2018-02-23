<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
  <li class="{{ setActiveRoute('admin.dashboard') }}">
    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
  </li>
  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Mantenimiento</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Configuración</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Documentos</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Comprobantes</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Roles</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Permisos</a>
      </li>      
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Sucursales</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver sucursales</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear sucursal</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Usuarios</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver usuarios</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.create') }}"><i class="fa fa-eye"></i> Crear usuario</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Marcas</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver marcas</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear marca</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Modelos</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver modelos</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear modelo</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Producto</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver productos</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear producto</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Proveedores</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver proveedores</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear proveedor</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Compras</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver compras</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Agregar compra</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Clientes</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver clientes</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Crear cliente</a>
      </li>  
    </ul>
  </li>

  <li class="treeview {{ setActiveRoute('admin.users.index') }}">
    <a href="#"><i class="fa fa-link"></i> <span>Ventas</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver ventas</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Generar venta</a>
      </li>  
    </ul>
  </li>

  {{-- <li class="treeview {{ setActiveRoute(['admin.users.index', 'admin.users.index.create']) }}">
    <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ setActiveRoute('admin.users.index') }}">
        <a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i> Ver usuarios</a>
      </li>
      <li class="{{ setActiveRoute('admin.users.index.create') }}">
        <a href="{{ route('admin.users.index.create') }}"><i class="fa fa-pencil"></i> Crear un usuario</a>
      </li>
    </ul>
  </li> --}}

</ul>