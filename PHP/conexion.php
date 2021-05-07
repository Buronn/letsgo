<?php
define("host_bd", "database-merken.ccvzxrt75imq.us-east-1.rds.amazonaws.com");
define("user_bd", "root");
define("pass_bd", "merquen1");
define("name_bd", "merquen");
$conexion = new mysqli(
    constant("host_bd"),
    constant("user_bd"),
    constant("pass_bd"),
    constant("name_bd")
);
