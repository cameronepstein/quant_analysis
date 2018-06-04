<?php
function formatData($av_data) {
  if($av_data['function'] = 'TIME_SERIES_INTRADAY') {
    $res = formatTimeSeriesIntradayData($av_data['data']);
  }
  return $res;
}

function formatTimeSeriesIntradayData($data) {
  $res = '';
  $php_formatted_data = json_decode($data, true);
  foreach($php_formatted_data['Time Series (1min)'] as $recorded_time_key=>$values) {
    $res .= '(\''.$php_formatted_data['Meta Data']['2. Symbol'].'\', \''.$php_formatted_data['Meta Data']['3. Last Refreshed'].'\', \''.$php_formatted_data['Meta Data']['6. Time Zone'].'\', \''.$recorded_time_key.'\', '.$values['1. open'].', '.$values['2. high'].', '.$values['3. low'].', '.$values['4. close'].', '.$values['5. volume'].'), ';
  }
  $trimmed_res = rtrim($res,', ');
  return $trimmed_res;
}
?>
