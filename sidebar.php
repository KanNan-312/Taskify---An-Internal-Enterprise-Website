<aside class="main-sidebar elevation-4" >
    <div class="dropdown shadow">
   	<a href="./" class="brand-link main-color">
      <div class="d-flex justify-content-center align-items-center" >
        <img src="./assets/img/white-icon.png" class="text-center" style="height:32px">
      </div>
    </a>
      
    </div>
    <div class="sidebar pb-4 sidebar-style">
      <nav class="" >
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard -->
          <li class="nav-item dropdown mt-1">
            <a href="./" class="nav-link nav-home">
              <i style="color: white;" class="nav-icon fa fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 

          <!-- Projects -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group" style="color: white;"></i>
              <p>
                Projects
              </p>
              <i class="right fa fa-angle-left" style="color: white;"></i>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_project" class="nav-link nav-new_project tree-item">
                  <i style="color: white;" class="fas fa-angle-right nav-icon"></i>
                  <p>New Project</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=project_list" class="nav-link nav-project_list tree-item">
                  <i style="color: white;" class="fas fa-angle-right nav-icon"></i>
                  <p>Project list</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Task -->
          <?php if($_SESSION['login_type'] != 1): ?>
          <li class="nav-item">
            <a href="./index.php?page=task_list" class="nav-link nav-task_list">
              <i class="fa fa-tasks nav-icon" style="color: white;"></i>
              <p>Task</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- Report -->
          <?php if($_SESSION['login_type'] != 3): ?>
           <li class="nav-item">
              <a href="./index.php?page=reports" class="nav-link nav-reports">
                <i class="fas fa-th-list nav-icon" style="color: white;"></i>
                <p>Report</p>
              </a>
          </li>
          <?php endif; ?>

          <!-- User -->
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users" style="color: white;"></i>
              <p>
                Users
              </p>
              <i class="right fa fa-angle-left" style="color: white;"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i style="color: white;" class="fa fa-angle-right nav-icon"></i>
                  <p>New User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i style="color: white;" class="fa fa-angle-right nav-icon"></i>
                  <p>User list</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>