<html>

<head>
    <title>Réservation</title>

</head>



<form action="" method="post">
    <input type="date" name="date"><br>
    <select type="text" name="emplacement">
        <option value="" selected="selected">-- Emplacement --</option>
        <option value="plage">La Plage</option>
        <option value="pins">Les Pins</option>
        <option value="maquis">Le Maquis</option>
    </select><br>
    <select type="text" name="habitat">
        <option value="" selected="selected">-- Type d'habitat --</option>
        <option value="tente">En Tente</option>
        <option value="cpgcar">En Camping-car</option>
    </select><br>
    <select type="text" name="dureesejour">
        <option value="" selected="selected">-- Nbr de jours --</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
    </select>
    <br>
    Accès à la borne électrique (2€/jr)<input type="radio" name="borne" value="2"><br>
    Accès au Disco-Club “Les girelles dansantes” (17€/jr)<input type="radio" name="disco" value="17"><br>
    Accès aux activités Yoga, Frisbee et Ski Nautique (pack à 30€/jr)<input type="radio" name="yfs" value="30"><br>
    <input type="submit" name="valider">
</form>






<?php

session_start();

if(isset($_POST['valider']))
{
    if(isset($_POST['borne']))
    {
        $option1=$_POST['borne'];
    }
    else
    {
        $option1=0;
    }
    if(isset($_POST['disco']))
    {
        $option2=$_POST['disco'];
    }
    else
    {
        $option2=0;
    }
    if(isset($_POST['yfs']))
    {
        $option3=$_POST['yfs'];
    }
    else
    {
        $option3=0;
    }
    $duree=$_POST['dureesejour'];

    $optiontotal= $option1 + $option2 + $option3;
    $totalsejour=($optiontotal*$duree) + $duree*10;

    if(!empty($_POST['dureesejour']) and !empty($_POST['date']) and !empty($_POST['emplacement']) and !empty($_POST['habitat']))
    {
        $date=$_POST['date'];
        $place=$_POST['emplacement'];
        $habitat=$_POST['habitat'];

        

        $connexion=mysqli_connect("Localhost","root","","camping");
        $requete = "SELECT date,habitat,emplacement FROM reservationplace WHERE emplacement='".$_POST['emplacement']."'";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        var_dump($resultat);

        $j=count($resultat);
        $placetotal=4;
        $placedispo=4;
        $i=0;



        while($i<$j)
        {

            if($resultat[$i][1]='tente')
            {
                $resultat[$i][1]=1;
                $placedispo=$placedispo - $resultat[$i][1];

            }
            if($resultat[$i][1]='cpgcar')
            {
                $resultat[$i][1]=2;
                $placedispo=$placedispo - $resultat[$i][1];
            }
            
            ++$i;

        }

        echo $placedispo.'<br/>';



        if(isset($_POST['borne']))
        {
            $_POST['borne']='oui';
        }
        else{
            $_POST['borne']='non';
        }
        if(isset($_POST['disco']))
        {
            $_POST['disco']='oui';
        }
        else{
            $_POST['disco']='non';
        }
        if(isset($_POST['yfs']))
        {
            $_POST['yfs']='oui';
        }
        else{
            $_POST['yfs']='non';
        }


        $connexion=mysqli_connect("Localhost","root","","camping");
        $requete="INSERT INTO reservationplace (date,emplacement,habitat,dureesejour,borne,disco,yfs,prixtotal,id_utilisateur) VALUES ('".$date."','".$place."','".$habitat."','".$_POST['dureesejour']."','".$_POST['borne']."','".$_POST['disco']."','".$_POST['yfs']."','".$totalsejour."','".$_SESSION['ID']."') ";
        $query=mysqli_query($connexion,$requete);

        echo 'reservation validé'.'<br/>';
        
        // echo 'Votre séjour est d\'une durée de '.$duree.' jours.'.'<br/>';
        // echo 'Votre séjour vous coûtera la sommes de '.$totalsejour.'€.';
    }
    else
    {
        echo 'Veuillez saisir les informations obligatoires'.'<br/>';
    }


}


    

    




?>




</html>