<?php //$this = new Controller_Core_Action();?>
<?php 
	$messages = $this->getMessages();
	if($messages) {
	    foreach ($messages as $key => $value) {
	        echo $value;
	    }
	} 
?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="skin/admin/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="skin/admin/css/OverlayScrollbars.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="skin/admin/css/admin.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">

    <b>~ Login Here ~</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <form action="<?php echo $this->getUrl('loginPost'); ?>" method="POST">
        <div class="input-group mb-3">
          <input class="form-control" type="email" name="admin[email]" required placeholder="Enter Email">
            <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input class="form-control" type="password" name="admin[password]" required placeholder="Enter Password">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" name="login" value="Login" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="skin/admin/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="skin/admin/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="skin/admin/js/adminlte.min.js"></script>
</body>



