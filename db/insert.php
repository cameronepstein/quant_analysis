<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function insertToDb($data) {
  include(dirname(__FILE__) . '/../config.php');
  include_once(dirname(__FILE__) . '/queryGenerator.php');
  $link = $doj_db_con;
  $schema_name = 'c_test';
  /* check connection */
  if (mysqli_connect_errno()) {
      printf('Connect failed: %s\n', mysqli_connect_error());
      exit();
  }
  /* Create table doesn't return a resultset */
  if (mysqli_query($link, generateQuery($data)) === TRUE) {
    print_r('Data Insert Complete: '.$data['security'].' / '.$data['data_type']);
  } else {
    print_r(mysqli_error($doj_db_con));
  }

  mysqli_close($link);
}
?>
