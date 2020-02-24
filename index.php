<html>

<head>
<title>Page principale</title>

</head>




<?php
session_start();
if(isset($_SESSION['login'])){
    echo '<a href="reservations.php">Réservations</a><br>
    <a href="deconnexion">Déconnexion</a><br>';
    if($_SESSION['login']=='admin'){
        echo '<a href="admin.php">Page admin</a><br>';
    }
    echo $_SESSION['login'];
}
else{
echo '<a href="connexion.php">Connexion</a><br>
    <a href="inscription.php">Inscription</a><br>';
}
?>



</html>