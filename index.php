<?php
include(dirname(__FILE__) . '/alphaVantage/index.php');
include(dirname(__FILE__) . '/db/dbCreator.php');
include(dirname(__FILE__) . '/db/insert.php');
include(dirname(__FILE__) . '/dataFormatter/dataFormatter.php');

// Set up project db
// runDbSetup();

/*
ADD desired securities and Alpha Vantage API functions here:
Securities $keys and $vals must stay in a specific order according to the AV api.

See docs here: https://www.alphavantage.co/documentation/
*/

$equity_securities = [
  [
  // NOTE: CHANGE THIS FUNCTIONS TIME SERIES INTRADAY KEY IN THE formatTimeSeriesIntradayData($data) function.
  // IT INCLUDRS (1min) in the key name and would not work if the interval time was changed here
    'function' => 'TIME_SERIES_INTRADAY',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'db_table' => 'time_series_intraday' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'SMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'EMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'WMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'DEMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'TEMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'TRIMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'KAMA',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'db_table' => 'moving_averages' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'MACD',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'fastperiod' => '12',
    'slowperiod' => '26',
    'signalperiod' => '9',
    'db_table' => 'moving_average_convergence_divergence' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'MACDEXT',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
    'fastperiod' => '12',
    'slowperiod' => '26',
    'signalperiod' => '9',
    'fastmatype' => '0', // Moving average type for the faster moving average. Integers 0 - 8 are accepted with the following mappings. 0 = Simple Moving Average (SMA), 1 = Exponential Moving Average (EMA), 2 = Weighted Moving Average (WMA), 3 = Double Exponential Moving Average (DEMA), 4 = Triple Exponential Moving Average (TEMA), 5 = Triangular Moving Average (TRIMA), 6 = T3 Moving Average, 7 = Kaufman Adaptive Moving Average (KAMA), 8 = MESA Adaptive Moving Average (MAMA).
    'slowmatype' => '0', // See above comment
    'signalmatype' => '0', // See above comment
    'db_table' => 'moving_average_convergence_divergence_ext' // NOT PART OF THE AV API. For project insert queries
  ],
  [
    'function' => 'STOCH',
    'symbol' => 'MSFT',
    'interval' => '1min',
    'fastkperiod' => '5', // The time period of the fastk moving average. Positive integers are accepted. By default,
    'slowkperiod' => '3',
    'slowdperiod' => '3', // The time period of the slowd moving average. Positive integers are accepted. By default,
    'slowkmatype' => '0', // Moving average type for the slowk moving average. Integers 0 - 8 are accepted with the following mappings. 0 = Simple Moving Average (SMA), 1 = Exponential Moving Average (EMA), 2 = Weighted Moving Average (WMA), 3 = Double Exponential Moving Average (DEMA), 4 = Triple Exponential Moving Average (TEMA), 5 = Triangular Moving Average (TRIMA), 6 = T3 Moving Average, 7 = Kaufman Adaptive Moving Average (KAMA), 8 = MESA Adaptive Moving Average (MAMA).
    'slowdmatype' => '0', // See above comment
    'db_table' => 'STOCH' // NOT PART OF THE AV API. For project insert queries
  ],
];
// Run api requests for each security
foreach($equity_securities as $api_params) {
  $res['security'] = $api_params['symbol'];
  $res['data_type'] = $api_params['function'];
  if (isset($api_params['outputsize'])) {
    $res['output_size'] = $api_params['outputsize'];
  }
  $res['db_table'] = $api_params['db_table'];
  $res['data'] = requestAVAPI($api_params);
  // print_r($res['data']);
  $res['csv_formatted_data'] = formatData($res);
  insertToDb($res);
}
?>
