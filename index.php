<?php
include(dirname(__FILE__) . '/alphaVantage/index.php');
include(dirname(__FILE__) . '/db/dbCreator.php');
include(dirname(__FILE__) . '/db/insert.php');
include(dirname(__FILE__) . '/dataFormatter/dataFormatter.php');

// Set up project db
// runDbSetup();

// ADD desired securities and Alpha Vantage API functions here:
$equity_securities = [
  'MSFT' => [
    'function' => 'TIME_SERIES_INTRADAY',
    'outputsize' => 'full',
  ],
];
// Run api requests for each security
foreach($equity_securities as $security => $api_params) {
  $res['security'] = $security;
  $res['data_type'] = $api_params['function'];
  $res['output_size'] = $api_params['outputsize'];
  $res['data'] = requestAVAPI($security, $api_params);
  // print_r($res['data']);
  $res['csv_formatted_data'] = formatData($res);
  insertToDb($res);
}
?>
