

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
header("Content-type: text/html; charset=utf-8");

require_once 'app/init.php';

$app = new App;
