<?php
include(dirname(__FILE__) . "/config.php");
$url = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=MSFT&interval=1min&apikey=".$alpha_vantage_key;
$data = file_get_contents($url);
print_r($data);
?>
