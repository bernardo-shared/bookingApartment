#!/usr/bin/php
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bernardo
 * Date: 4/8/13
 * Time: 9:27 AM
 * To change this template use File | Settings | File Templates.ç
 * Execute: ./src/Trivago/TestJQueryGridBundle/DataFixtures/load_data.php
 */

set_time_limit(0);
ini_set('memory_limit', '1024M');

$mysqli = new mysqli('localhost', 'root', 'root', 'booking');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

$salt = 'fgv932g2e9dshdfkdjgf927gf8hlz082';
$password = '0000';
$password = sha1($password);
$email = 'bernardo@gmail.com';
$username = 'bernardo';

$mysqli->query("INSERT INTO user (username, email, password, is_active, salt)
                VALUES ('$username', '$email', '$password', 1, '$salt')");

$mysqli->close();