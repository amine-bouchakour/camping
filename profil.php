<?php
session_start();
if(isset($_SESSION['login'])){


?>

<html>

<head>
<title>Page profil</title>

</head>

<?php
echo '<h1>'.'Toutes vos réservations'.'</h1><br/>';


$connexion=mysqli_connect("localhost","root","","camping");
$requete="SELECT * FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id WHERE login='".$_SESSION['login']."' ORDER BY date DESC";
$query=mysqli_query($connexion,$requete);
$resultat=mysqli_fetch_all($query);
//var_dump($resultat);

// CALCUL SOMME TOTAL DEBOURSER PAR UTILISATEUR
$requete0="SELECT SUM(prixtotal) FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id WHERE login='".$_SESSION['login']."'";
$query0=mysqli_query($connexion,$requete0);
$resultat0=mysqli_fetch_row($query0);
// var_dump($resultat0);
// echo $requete0;

$prixtotal=$resultat0[0];
$nb_reservation=count($resultat);

echo '<p>Réservation fait par = '.ucfirst($_SESSION['login']).'<br/>
Nombre de réservation total = '.$nb_reservation.'</br>
Dépense total = '.$prixtotal.' euros</p>';

$j=0;
foreach($resultat as $ligne){
    $login=$ligne[1];
    $date=$ligne[1];
    $emplacement=$ligne[2];
    $habitat=ucfirst($ligne[3]);
    $duree=$ligne[4];
    $borne=ucfirst($ligne[5]);
    $disco=ucfirst($ligne[6]);
    $yfs=ucfirst($ligne[7]);
    $id=$ligne[0];
echo "<table>
<tr>
<td>$date</td>
<td>$emplacement</td>
<td>$habitat</td>
<td>$duree jours</td>
<td>$borne</td>
<td>$disco</td>
<td>$yfs</td>
<td><a href='profil.php?id=$ligne[0]'>Supprimer réservations<a></td>
</tr>
</table>";
}


if(isset($_GET['id'])){
    $requete1="DELETE FROM reservationplace WHERE id='".$_GET['id']."'";
    $query1=mysqli_query($connexion,$requete1);
    $_GET['id']=0;
}

?>



<?php

}
?>