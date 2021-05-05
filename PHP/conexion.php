<?php
define("host_bd", "25.46.196.238");
define("user_bd", "root");
define("pass_bd", "");
define("name_bd", "merquen");
$conexion = new mysqli(
    constant("host_bd"),
    constant("user_bd"),
    constant("pass_bd"),
    constant("name_bd")
);
