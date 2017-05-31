<div class="container header-block">
  <div class="col-xs-12 col-md-6">
    <ul class="list-unstyled logo-tag">
      <li><a href="#"><img style="width: 150px;" class="logo" src="/public/img/logo.png"></a></li>
    </ul>
  </div>
  <div class="col-xs-12 col-md-6">
         <!-- <form action="" class="search-form">
     <div class="form-group has-feedback">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="search">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </form> -->
  </div>
</div>

<div class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <ul class="nav navbar-nav">
        <li><a href="/">Home</a></li>
        <li><a href="/home/index">User</a></li>
      </ul>
    </ul>
     <ul class="nav navbar-nav navbar-right">

       <?php
         if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
           echo "<li><a href='/auth/info'>user info</a></li><li><a href='/auth/logout'>Log Out</a></li>";
         }
        ?>
     </ul>
  </div>
</div>
