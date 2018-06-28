<?php
function requestAVApi($api_params) {
  include(dirname(__FILE__) . '/../config.php');
  $url = 'https://www.alphavantage.co/query?';
  foreach($api_params as $key => $val) {
    $url .= '&'.$key.'='.$val;
  }
  $url .= '&apikey='.$alpha_vantage_key;
  $data = file_get_contents($url);
  return $data;
}
?>
