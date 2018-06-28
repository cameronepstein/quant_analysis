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
];
// Run api requests for each security
foreach($equity_securities as $api_params) {
  $res['security'] = $api_params['symbol'];
  $res['data_type'] = $api_params['function'];
  $res['output_size'] = $api_params['outputsize'];
  $res['db_table'] = $api_params['db_table'];
  $res['data'] = requestAVAPI($api_params);
  // print_r($res['data']);
  $res['csv_formatted_data'] = formatData($res);
  insertToDb($res);
}
?>
