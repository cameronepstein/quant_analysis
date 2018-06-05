<?php
function requestAVApi($security, $api_params) {
  include(dirname(__FILE__) . '/../config.php');
  $url = 'https://www.alphavantage.co/query?function='.$api_params['function'].'&symbol='.$security.'&interval=1min&outputsize=full&apikey='.$alpha_vantage_key;
  $data = file_get_contents($url);
  return $data;
}
?>
