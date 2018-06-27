<?php
include(dirname(__FILE__) . '/alphaVantage/index.php');
include(dirname(__FILE__) . '/db/dbCreator.php');
include(dirname(__FILE__) . '/db/insert.php');
include(dirname(__FILE__) . '/dataFormatter/dataFormatter.php');

// Set up project db
// runDbSetup();

// ADD desired securities and Alpha Vantage API functions here:
$equity_securities = [
  [
    'security' => 'MSFT',
    'function' => 'TIME_SERIES_INTRADAY',
    'outputsize' => 'full',
  ],
  [
    'security' => 'MSFT',
    'function' => 'SMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ],
  [
    'security' => 'MSFT',
    'function' => 'EMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ],
  [
    'security' => 'MSFT',
    'function' => 'WMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ],
  [
    'security' => 'MSFT',
    'function' => 'DEMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ],
  [
    'security' => 'MSFT',
    'function' => 'TEMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ],
  [
    'security' => 'MSFT',
    'function' => 'TRIMA',
    'outputsize' => 'full',
    'time_period' => '10', // Number of data points used to calculate each moving average value.
    'series_type' => 'close', // The desired price type in the time series. Four types are supported: can be open, close, high or low
  ]
];
// Run api requests for each security
foreach($equity_securities as $api_params) {
  $res['security'] = $api_params['security'];
  $res['data_type'] = $api_params['function'];
  $res['output_size'] = $api_params['outputsize'];
  $res['data'] = requestAVAPI($res['security'], $api_params);
  // print_r($res['data']);
  $res['csv_formatted_data'] = formatData($res);
  insertToDb($res);
}
?>
