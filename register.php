<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reģistrācija</title>
    
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <h1 class="heading">Reģistrācija</h1>
<?php 
require_once('../config/config.php');
require_once('../src/DB.php');
require_once('../src/Register.php');

$db = new DB(SERVER, USER, PW, DB);
$register = new Register($db->conn);

?>

<br>
<a class= "link" href="index.php">Uz sākumlapu</a>
<br>

</body>
</html>