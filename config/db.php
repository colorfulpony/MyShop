<?php


// Подключение к базе данных 

function db() {
  $dbHost = '127.0.0.1';
  $dbUser = 'root';
  $dbPass = '';
  $dbName = 'myshop';

  $db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
$db->set_charset('utf8');
 
  if($db->connect_errno) {
      die('MySQL access denied.');
  }

 return $db;
}