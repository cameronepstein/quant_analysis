<?php
function runQuery($query, $params) {
  include(dirname(__FILE__) . '/../config.php');
  $link = $doj_db_con;
  if($link->connect_error) {
    exit('Error connecting to database');
  } else {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link->set_charset('utf8mb4');
    $stmt = $link->prepare($query);
    // $stmt->bind_param("isss", $uddri, $delreq, $uid, $eml);
    $stmt->bind_param('isss', $params);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) exit('No rows');
    while($row = $result->fetch_assoc()) {
      $res = $row;
    }
    var_export($res);
    $stmt->close();
  }
}
?>
