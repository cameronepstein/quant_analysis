<?php
include(dirname(__FILE__) . '/alphaVantage/index.php');
include(dirname(__FILE__) . '/db/dbCreator.php');
// Set up project db
runDbSetup();

// ADD desired securities and Alpha Vantage API functions here:
$equity_securities = [
  'MSFT' => [
    'function' => 'TIME_SERIES_INTRADAY',
    'outputsize' => 'compact',
  ],
];
// Run api requests for each security
foreach($equity_securities as $security => $api_params) {
  $res['security'] = $security;
  $res['data_type'] = $api_params['function'];
  $res['data'] = requestAVAPI($security, $api_params);
  print_r($res['data']);
}
?>
