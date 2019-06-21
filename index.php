<?php
session_start();
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Darāmo lietu saraksta aplikācija</title>
    <link rel="stylesheet" href="./styles/style.css">
   <!--  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->
 <!-- <script src="scripts/vendor/jquery-3.4.1.min.js"></script>
  <script src="scripts/form.js" defer></script> -->
</head>
<body>
    <h1 class="heading" >Darāmo lietu saraksts</h1>

    <a class= "link" href="login.php">Ielogojies vai izlogojies no konta</a> 
<br>
<a class= "link" href="register.php">Reģistrējies šeit!</a>
<br>
<br>
<br>
<h3> Pievieno jaunu uzdevumu: </h3>
<br>

<?php
require_once('../config/config.php');
require_once('../src/DB.php');
require_once('../src/Form.php');
require_once('../src/Table.php');
$db = new DB(SERVER, USER, PW, DB);
$form = new Form($db->conn);
$table = new Table($db->conn);




?>


</body>
</html>