<?php 

if (getenv('JAWSDB_MARIA_URL') !== false) {
  $dbparts = parse_url(getenv('JAWSDB_MARIA_URL'));
  
  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');
} else {
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'ecfgaragevparrot';
};
