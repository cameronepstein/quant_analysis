<?php
function generateQuery($data) {
  if ($data['data_type'] === 'TIME_SERIES_INTRADAY') {
    $query = 'INSERT INTO c_test.time_series_intraday (security, last_refreshed, time_zone, timestamp, open, high, low, close, volume) VALUES '.$data['csv_formatted_data'];
  }
  return $query;
}
?>
