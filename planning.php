<?php
session_start();

?>
<html>
<head>
<title>Planning</title>
<link rel="stylesheet" href="camping.css">
</head>
<?php

if(isset($_SESSION['login'])){
    echo '<a href="index.php">Page principale</a><br/><br/>';


$connexion=mysqli_connect("Localhost","root","","camping");
$requete="SELECT * FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id ORDER BY datedebut DESC";
$query=mysqli_query($connexion,$requete);
$resultat=mysqli_fetch_all($query);

//var_dump($resultat);

if(!empty($resultat)){
    $Id=$resultat[0][9];
    // echo $Id;
}
$nb_reservation=count($resultat);


$j=0;
foreach($resultat as $ligne){
    $login=$ligne[1];
    $datedebut=$ligne[1];
    $datefin=$ligne[2];
    $emplacement=$ligne[3];
    $habitat=ucfirst($ligne[4]);
    $duree=$ligne[5];
    $borne=ucfirst($ligne[6]);
    $disco=ucfirst($ligne[7]);
    $yfs=ucfirst($ligne[8]);
    $id=$ligne[0];
echo "<table class='tableplanning'><thead>
<td>Date de début</td>
<td>Date de fin</td>
<td>Lieu</td>
<td>Type d'habitat</td>
<td>Durée du séjour</td>
<td>Option borne electrique</td>
<td>Option Acces Discothèque</td>
<td>Option Formule YFS</td>";
if(isset($_SESSION['login']) and $_SESSION['login']=="admin"){
   echo "<td>Réservations</td>";
}
echo
"</thead>
<tr>
<td>$datedebut</td>
<td>$datefin</td>
<td>$emplacement</td>
<td>$habitat</td>
<td>$duree jours</td>
<td>$borne</td>
<td>$disco</td>
<td>$yfs</td>";
if(isset($_SESSION['login']) and $_SESSION['login']=="admin"){
    echo "<td><a href='profil.php?id=$ligne[0]'>Supprimer réservations<a></td>";
 }
echo
"</tr>
</table><br/>";
}

}
else{
    header('location:connexion.php');
}


?>

</html>