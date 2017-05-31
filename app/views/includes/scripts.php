<script src="/public/smartmenus/libs/jquery/jquery.js"></script>
<script src="/public/bootstrap/js/bootstrap.min.js"></script>
<?php
  if (isset($_SESSION['email']) && $_SESSION['email'] !== '') {
    echo '<script src="/public/js/myscript.js"></script>';
  }
 ?>
<script src="/public/js/scripts.js"></script>
