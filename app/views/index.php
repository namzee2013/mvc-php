<!DOCTYPE html>
<html>
  <head>
    <?php include('includes/head.php'); ?>
  </head>
  <body>
    <div class="wrapper">
      <header>
        <?php
          if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
            include('includes/header.php');
          }
        ?>
      </header>
      <main>
        <div class="container">
          <?php
            require_once 'master.php';
          ?>
        </div>
      </main>
      <footer>
        <?php
          if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
            include('includes/footer.php'); 
          }
        ?>
      </footer>
    </div>
    <?php include('includes/scripts.php'); ?>
  </body>
</html>
