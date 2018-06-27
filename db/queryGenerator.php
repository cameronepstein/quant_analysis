<?php
function generateQuery($data) {
  if ($data['data_type'] === 'TIME_SERIES_INTRADAY') {
    $query = 'INSERT INTO c_test.time_series_intraday (security, last_refreshed, time_zone, timestamp, open, high, low, close, volume) VALUES '.$data['csv_formatted_data'].'ON DUPLICATE KEY UPDATE open = open, high=high, low=low, close=close, volume=volume';
  } else if ($data['db_table'] === 'moving_averages') {
    $query = 'INSERT INTO c_test.moving_averages (security, technical_indicator, time_interval, time_period, series_type, time_zone, last_refreshed, recorded_time, value) VALUES'.$data['csv_formatted_data'].'ON DUPLICATE KEY UPDATE value=value';
  }
  return $query;
}
?>
