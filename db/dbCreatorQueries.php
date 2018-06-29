<?php
$STOCH_table_query = "CREATE TABLE c_test.STOCH
(
    symbol VARCHAR(6) NOT NULL,
    indicator VARCHAR(5) NOT NULL,
    last_refreshed TIMESTAMP NOT NULL,
    time_interval VARCHAR(10) NOT NULL,
    fastk_period INT NOT NULL,
    slowk_period INT NOT NULL,
    slowk_ma_type INT NOT NULL,
    slowd_period INT NOT NULL,
    slowd_ma_type INT NOT NULL,
    time_zone VARCHAR(50) NOT NULL,
    recorded_time TIMESTAMP NOT NULL,
    slowd DECIMAL(6,4) NOT NULL,
    slowk DECIMAL(6,4) NOT NULL,
    CONSTRAINT STOCH_pk PRIMARY KEY (symbol, last_refreshed, time_interval, fastk_period, slowk_period, slowk_ma_type, slowd_period, slowd_ma_type, timezone, recorded_time)
)";
?>
