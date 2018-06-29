<?php
function generateQuery($data) {
  if ($data['db_table'] === 'time_series_intraday') {
    $query = 'INSERT INTO c_test.time_series_intraday (security, last_refreshed, time_zone, timestamp, open, high, low, close, volume) VALUES '.$data['csv_formatted_data'].'ON DUPLICATE KEY UPDATE open = open, high=high, low=low, close=close, volume=volume';
  } else if ($data['db_table'] === 'moving_averages') {
    $query = 'INSERT INTO c_test.moving_averages (security, technical_indicator, time_interval, time_period, series_type, time_zone, last_refreshed, recorded_time, value) VALUES'.$data['csv_formatted_data'].'ON DUPLICATE KEY UPDATE value=value';
  } else if ($data['db_table'] === 'moving_average_convergence_divergence') {
    $query = 'INSERT INTO c_test.MACD (symbol, indicator, time_interval, fast_period, slow_period, signal_period, series_type, time_zone, recorded_time, MACD_signal, MACD_hist, MACD, last_refreshed) VALUES '.$data['csv_formatted_data'].' ON DUPLICATE KEY UPDATE MACD_signal=MACD_signal, MACD_hist=MACD_hist, MACD=MACD';
  } else if ($data['db_table'] === 'moving_average_convergence_divergence_ext') {
    $query = 'INSERT INTO c_test.MACDEXT (symbol, indicator, time_interval, fast_period, slow_period, signal_period, fast_ma_type, slow_ma_type, signal_ma_type, series_type, time_zone, recorded_time, MACD_signal, MACD_hist, MACD, last_refreshed) VALUES '.$data['csv_formatted_data'].' ON DUPLICATE KEY UPDATE MACD_signal=MACD_signal, MACD_hist=MACD_hist, MACD=MACD';
  } else if ($data['db_table'] === 'STOCH') {
    $query = 'INSERT INTO c_test.STOCH (symbol, indicator, last_refreshed, time_interval, fastk_period, slowk_period, slowk_ma_type, slowd_period, slowd_ma_type, time_zone, recorded_time, slowd, slowk) VALUES '.$data['csv_formatted_data'].' ON DUPLICATE KEY UPDATE slowd=slowd, slowk=slowk';
  }
  return $query;
}
?>
