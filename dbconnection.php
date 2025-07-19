<?php
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
if ($db_pass === 'none') {
    $db_pass = '';
}
$db_name = getenv('DB_NAME');

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Connection failed.");
}
?>
