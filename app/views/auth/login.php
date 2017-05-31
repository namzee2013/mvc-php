
<div class="panel panel-default">
  <div class="panel-heading">
    <h1>LOGIN</h1>
  </div>
  <div class="panel-body">
    <div class="text-center">
        <?php
        if (isset($_SESSION['loginErr']) && $_SESSION['loginErr'] !== '') {
          echo '<div class="alert alert-danger">'.$_SESSION['loginErr'].'</div>';
        }
         ?>
    </div>
    <form class="" action="find" method="post">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="email">Email<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="text" name="email" value="">
            <span class="error">
              <?php
              if (isset($_SESSION['emailErr']) && $_SESSION['emailErr'] !== '') {
                echo $_SESSION['emailErr'];
              }
               ?>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-3">
            <label class="pull-right" for="name">password<span class="error">*</span></label>
          </div>
          <div class="col-xs-12 col-md-6">
            <input class="form-control" type="password" name="password" value="">
            <span class="error">
              <?php
              if (isset($_SESSION['passwordErr']) && $_SESSION['passwordErr'] !== '') {
                echo $_SESSION['passwordErr'];
              }
               ?>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-md-push-3">
            <input type="checkbox" name="submit" value="Submit">
            remeber me!
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-xs-12 col-md-6 col-md-push-3">
            <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            <a href="register">register</a>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="panel-footer">

  </div>
</div>
