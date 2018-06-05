<?php
function generateQuery($data) {
  if ($data['data_type'] === 'TIME_SERIES_INTRADAY') {
    $query = 'INSERT INTO c_test.time_series_intraday (security, last_refreshed, time_zone, timestamp, open, high, low, close, volume) VALUES '.$data['csv_formatted_data'];
  } else if ($data['data_type'] === 'SMA') {
    $query = 'INSERT INTO c_test.SMA (security, technical_indicator, time_interval, time_period, series_type, time_zone, last_refreshed, recorded_time, sma_value) VALUES'.$data['csv_formatted_data'];
  }
  return $query;
}
?>
