<?php
function formatData($av_data) {
  if($av_data['data_type'] === 'TIME_SERIES_INTRADAY') {
    $res = formatTimeSeriesIntradayData($av_data['data']);
  } else if ($av_data['data_type'] === 'SMA' || $av_data['data_type'] === 'EMA' || $av_data['data_type'] === 'WMA' || $av_data['data_type'] === 'DEMA' || $av_data['data_type'] === 'TEMA'  || $av_data['data_type'] === 'TRIMA') {
    $res = formatMovingAverageData($av_data);
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

function formatMovingAverageData($data) {
  $res = '';
  $php_formatted_data = json_decode($data['data'], true);
  foreach($php_formatted_data['Technical Analysis: '.$data['data_type']] as $recorded_time_key=>$values) {
    $res .= '( \''.$php_formatted_data['Meta Data']['1: Symbol'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['2: Indicator'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['4: Interval'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['5: Time Period'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['6: Series Type'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['7: Time Zone'];
    $res .= '\', \''.$php_formatted_data['Meta Data']['3: Last Refreshed'];
    $res .= '\', \''.$recorded_time_key;
    $res .= '\', '.$values[$data['data_type']].'), ';
  }
  $trimmed_res = rtrim($res,', ');
  return $trimmed_res;
}
?>
