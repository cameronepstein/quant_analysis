<?php
function requestAVApi($security, $api_params) {
  include(dirname(__FILE__) . '/../config.php');
  $url = 'https://www.alphavantage.co/query?function='.$api_params['function'].'&symbol='.$security.'&interval=1min&outputsize='.$api_params['outputsize'];
  if ($api_params['function'] === 'SMA' || $api_params['function'] === 'EMA' || $api_params['function'] === 'WMA' || $api_params['function'] === 'DEMA') {
    $url .= '&time_period='.$api_params['time_period'].'&series_type='.$api_params['series_type'];
  }
  $url .= '&apikey='.$alpha_vantage_key;
  $data = file_get_contents($url);
  return $data;
}
?>
