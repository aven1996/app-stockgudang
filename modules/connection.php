<?php
$conn = new mysqli("localhost","root","","stock_gudang_sma");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>