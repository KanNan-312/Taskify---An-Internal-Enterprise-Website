<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php
  // if not logged in, prompt to log in page
	if(!isset($_SESSION['login_id']))
      header('location:login.php');
  // start db connection
  include 'db_connect.php';
	include 'header.php' 
?>
<!-- use utilities from adminlte -->
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php
    $page_title = isset($_GET['page']) ? $_GET['page'] : 'home';
    $page_title = ucwords(implode(" ", explode("_", $page_title)));
  ?>
  <?php include 'topbar.php' ?>
  <?php include 'sidebar.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white"></div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pt-4">
         <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            if(!file_exists($page.".php")){
                include '404.html';
            }else{
            include $page.'.php';

            }
          ?>
      </div><!--/. container-fluid -->
    </section>

  <!-- Confirm modal -->
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm'>Continue</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>

  <!-- Data modal -->
  <div class="modal fade" id="data_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#data_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" id='cancel' data-bs-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>

  <!-- View modal -->
  <div class="modal fade" id="view_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>

  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 Web Programming-Group 6 .</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Taskify </b>
    </div>
  </footer>
</div>

<?php 
  // include 'footer.php';
?>
</body>

<script>
  // initialize document when loaded
	$(document).ready(function(){
	  $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
  })

  window.start_load = function(){
    $('body').prepend('<div id="preloader2"></div>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }

  // constructor for data modal
  window.dataModal = function(title = '' , url=''){
    // title: title of the modal
    // url: url that renders modal body

    $.ajax({
      url:url,
      method: "GET",
      error: err => {
        console.log(err)
        alert("An error occured")
      },
      success:function(resp){
        if(resp){
          $('#data_modal .modal-title').html(title)
          $('#data_modal .modal-body').html(resp)
          $('#data_modal').modal('show')
        }
      }
    })
  }

  // constructor for view modal
  window.viewModal = function(title = '' , url=''){
    start_load()
    $.ajax({
      url:url,
      method: "GET",
      error: err => {
        console.log(err)
        alert("An error occured")
      },
      success:function(resp){
        if(resp){
          $('#view_modal .modal-title').html(title)
          $('#view_modal .modal-body').html(resp)
          $('#view_modal').modal('show')
        }
      }
    })
  }

  // contructor for confirm modal
  window.confirmModal = function(msg='',func='',params = []){
    $('#confirm_modal #confirm').attr('onclick',func+"("+params.join(',')+")")
    $('#confirm_modal .modal-body').html(msg)
    $('#confirm_modal').modal('show')
  }

  window.alert_toast = function(msg = 'TEST',bg = 'success' ,pos='top-end'){
    var Toast = Swal.mixin({
    toast: true,
    showConfirmButton: false,
    timer: 5000
    });
    Toast.fire({
      position: pos,
      icon: bg,
      title: msg
    })
  }

  $('.number').on('input keyup keypress',function(){
      var val = $(this).val()
      val = val.replace(/[^0-9]/, '');
      val = val.replace(/,/g, '');
      val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
      $(this).val(val)
  })
</script>
</html>

