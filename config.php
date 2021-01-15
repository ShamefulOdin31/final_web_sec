<?php
  // Config code for blog
  define('DEBUG',true);

  if (!DEBUG) {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
  } else {
    error_reporting(E_ALL);
  }

  define('ADMIN_ADDRESS','blog_admin@mailinator.com');

  define('DB_HOSTNAME', 'localhost');
  define('DB_USER',     'bloguser');
  define('DB_PASSWORD', 'password');
  define('DB_DATABASE', 'blog');

  function format_mysql_datetime($datetime) {
    $time = strtotime($datetime);
    return date('F j, Y, g:i a', $time);
  }

  function redirect($script_name = 'index.php') {
    header("Location: $script_name");
    exit;
  }

  // Config code for the login
  //Define variables needed to connect to the MySQL database
  define('DB_DSN', 'mysql:host=localhost;dbname=blog;charset=utf8');
  define('DB_USER1', 'bloguser');
  define('DB_PASS', 'password');

  //Connect to the database. If the connection fails the main form will not display
  try {
      $db = new PDO(DB_DSN, DB_USER1, DB_PASS);
  } catch (PDOException $e) {
      echo 'Error: '.$e->getMessage();
      die(); // Force execution to stop on errors.
  }
?>