<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
  <script src="assets/ckeditor/ckeditor.js"></script>

</head>
<body>
<div class="container-scroller">

    <?php require_once 'header.php';
    ?>
    <div class="container-fluid page-body-wrapper">
      <?php require_once 'sidebar.php';?>
      <div class="main-panel">
        <div class="content-wrapper" style="overflow-x:auto">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <section class="content-header">
                  <?php if (isset($_SESSION['error'])): ?>
                      <div class="alert alert-danger">
                          <?php
                          echo $_SESSION['error'];
                          unset($_SESSION['error']);
                          ?>
                      </div>
                  <?php endif; ?>

                  <?php if (!empty($this->error)): ?>
                      <div class="alert alert-danger">
                          <?php
                          echo $this->error;
                          ?>
                      </div>
                  <?php endif; ?>

                  <?php if (isset($_SESSION['success'])): ?>
                      <div class="alert alert-success">
                          <?php
                          echo $_SESSION['success'];
                          unset($_SESSION['success']);
                          ?>
                      </div>
                  <?php endif; ?>
                </section>
                <?php echo $this->content; ?>
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
    <?php require_once 'footer.php'; ?>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
</div>
<style>
  .pagination{
    
  }
  .pagination li{
    border: solid 1px black;
    padding: 10px;
  }
</style>
<!-- ./wrapper -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
<script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/template.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
