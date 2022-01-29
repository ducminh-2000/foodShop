<h4>Hello! let's get started</h4>
<h6 class="fw-light">Sign in to continue.</h6>
<form class="pt-3" method="POST" action="">
    <div class="form-group">
        <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
    </div>
    <div class="mt-3">
        <input type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN"/>
    </div>
    <div class="text-center mt-4 fw-light">
        Don't have an account? <a href="index.php?controller=login&action=register" class="text-primary">Create</a>
    </div>
</form>