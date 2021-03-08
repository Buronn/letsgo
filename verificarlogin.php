<?php
    require 'conexion.php';
    session_start();
    $usuario = $_POST['user'];
    $password = $_POST['pass'];
    $sql = "select Nombre,Password from usuarios"
