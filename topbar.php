<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light shadow">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <?php if(isset($_SESSION['login_id'])): ?>
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fa fa-bars"></i></a>
    </li>
  <?php endif; ?>
    <li>
      <a class="nav-link d-flex align-items-center"  href="./" role="button">
        <div class="fw-bolder fs-5"><?php echo $page_title;?></div>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ms-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fa fa-expand-arrows-alt fa-lg"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" href="javascript:void(0)">
        <i class="fa fa-user-circle fa-lg"></i>
      </a>
      <div class="dropdown-menu" aria-labelledby="account_settings" style="left: auto; right: 0;">
        <div class="dropdown-item d-flex align-items-center">
          <i class="fa fa-user-circle fa-2x me-2"></i>
          <div>
            <div class="fw-bold"><?php echo ucwords($_SESSION['login_firstname'].' '.$_SESSION['login_lastname']) ?></div>
            <div class="fst-italic"><?php echo $_SESSION['login_email'] ?></div>
          </div>
        </div>
        <hr class="dropdown-divider border border-top-1">
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#data_modal" href="javascript:void(0)" id="manage_profile"><i class="fa fa-cog"></i> Manage Profile</a>
        <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<script>

  $('#manage_profile').click(function(){
    dataModal("Mange profile", 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>
