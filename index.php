<?php
include(dirname(__FILE__) . "/alphaVantage/index.php");
// ADD desired securities and Alpha Vantage API functions here:
$equity_securities = [
  "MSFT" => "TIME_SERIES_INTRADAY"
];
// Run api requests for each security
foreach($equity_securities as $security => $api_function) {
  $res["security"] = $security;
  $res["data_type"] = $api_function;
  $res["data"] = requestAVAPI($security, $api_function);
  print_r($res["data"]);
}
?>
