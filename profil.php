<?php
session_start();
if(isset($_SESSION['login'])){


?>

<html>

<head>
<title>Page profil</title>

</head>

<?php
echo $_SESSION['login'].'<br/>';

}
?>