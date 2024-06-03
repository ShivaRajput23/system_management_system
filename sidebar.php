<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=$baseurl?>/index.php" class="brand-link">
      <img src="<?=$baseurl?>/assets/img.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Mediatrenz</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
              <a href="<?=$baseurl?>/index.php" class="nav-link <?php checkactivemenu($baseurl.'/index.php') ; ?> <?php checkactivemenu($baseurl.'/') ; ?>">
                <i class="nav-icon fas fa-stream"></i>
                <p>Dashboard</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="<?=$baseurl?>/system_data.php" class="nav-link <?php checkactivemenu($baseurl.'/system_data.php');  ?>">
                <i class="nav-icon fas fa-laptop"></i>
                <p>
                  System Data
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="<?=$baseurl?>/employees.php" class="nav-link <?php checkactivemenu($baseurl.'/employees.php');  ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employees
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$baseurl?>/inventories.php" class="nav-link <?php checkactivemenu($baseurl.'/inventories.php' ); ?>">
              <i class="nav-icon far fa-hdd"></i>
              <p>
                Inventories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=$baseurl?>/type.php" class="nav-link <?php checkactivemenu($baseurl.'/type.php');  ?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Add Inventories Type
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>