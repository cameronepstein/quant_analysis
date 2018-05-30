<?php
function runDbSetup() {
  include(dirname(__FILE__) . '/../config.php');
  include(dirname(__FILE__) . '/runDbQuery.php');
  $link = $doj_db_con;
  $schema_name = 'c_test';
  /* check connection */
  if (mysqli_connect_errno()) {
      printf('Connect failed: %s\n', mysqli_connect_error());
      exit();
  }

  /* Create table doesn't return a resultset */
  if (mysqli_query($link, 'CREATE SCHEMA IF NOT EXISTS '.$schema_name) === TRUE) {
      printf('Schema '.$schema_name.' successfully created.\n');
  }

  mysqli_close($link);
}
?>
