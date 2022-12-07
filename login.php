<!DOCTYPE html>
<html lang="en">
<?php 
  session_start();
  include('./db_connect.php');
?>
<?php
  // if user already logged in
  if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");
?>
<?php include 'header.php' ?>
<body>

<section class="vh-100 main-color"">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="./assets/img/login-form.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height:40rem" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form id="login-form">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img src="./assets/img/logo.png" alt="logo"s>
                    <span class="h1 fw-bold mb-0">TASKIFY</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example17">Email address:</label>

                    <input type="email" name="email" required placeholder="Email" class="form-control form-control-lg" />
                  </div>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example27">Password:</label>

                    <input type="password" name="password" required placeholder="Password" class="form-control form-control-lg" />
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  </div>


                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    // start_load()

    // clear the alert screen 
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    
    // send AJAX request
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        // end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          // end_load();
        }
      }
    })
  })
  })
</script>
<!-- <?php 
// include 'footer.php' 
?> -->

</body>
</html>