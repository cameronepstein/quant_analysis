<?php
function requestAVApi($security, $api_params) {
  include(dirname(__FILE__) . '/../config.php');
  $url = 'https://www.alphavantage.co/query?function='.$api_params['function'].'&symbol='.$security.'&interval=1min&outputsize='.$api_params['outputsize'];
  if (isset($api_params['time_period'])) {
    $url .= '&time_period='.$api_params['time_period'];
  }
  if (isset($api_params['series_type'])) {
    $url .= '&series_type='.$api_params['series_type'];
  }
  $url .= '&apikey='.$alpha_vantage_key;
  $data = file_get_contents($url);
  return $data;
}
?>
