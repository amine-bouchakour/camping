<html>

<?php
session_start();
if (isset($_SESSION['login']))
{

    echo '<a href="index.php">Page principale</a><br/><br/>';
    $connexion=mysqli_connect("Localhost","root","","camping");
    $requete = "SELECT jour,borne,disco,yfs FROM tarif";
    $query=mysqli_query($connexion,$requete);
    $resultat=mysqli_fetch_all($query);

    // DEFINITION TARIF PAR REQUETE BDD
    $tarifjour=$resultat[0][0];
    $tarifborne=$resultat[0][1];
    $tarifdisco=$resultat[0][2];
    $tarifyfs=$resultat[0][3];

    ?>
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
        Accès à la borne électrique (<?php echo $tarifborne; ?>€/jr)<input type="radio" name="borne" value="<?php echo $tarifborne ?>"><br>
        Accès au Disco-Club “Les girelles dansantes” (<?php echo $tarifdisco; ?>€/jr)<input type="radio" name="disco" value="<?php echo $tarifdisco ?>"><br>
        Accès aux activités Yoga, Frisbee et Ski Nautique (pack à <?php echo $tarifyfs; ?>€/jr)<input type="radio" name="yfs" value="<?php echo $tarifyfs ?>"><br>
        <input type="submit" name="valider">
    </form>
    <?php
}
else
{
    echo 'La page est inacessible si vous n\'êtes connecté.';
}
?>







<?php



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

       

    if(!empty($_POST['dureesejour']) and !empty($_POST['date']) and !empty($_POST['emplacement']) and !empty($_POST['habitat']))
    {
        $date=$_POST['date'];

        $habitat=$_POST['habitat'];
        $place=$_POST['emplacement'];


        $connexion=mysqli_connect("Localhost","root","","camping");
        $requete = "SELECT habitat,date FROM reservationplace WHERE emplacement='".$place."' and date='".$date."'";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);

        $j=count($resultat);
        $placetotal=4;
        $placedispo=4;
        $i=0;
        while($i<$j)
        {

            if($resultat[$i][0]=="cpgcar")
            {
                
                $placedispo=$placedispo - 2;
                //echo $resultat[$i][0].'<br/>';
                //echo 'Il reste '.$placedispo.' de place disponible<br/><br/>';
                ++$i;

            }
            else
            {
                $placedispo=$placedispo - 1;
                //echo $resultat[$i][0].'<br/>';
                //echo 'Il reste '.$placedispo.' de place disponible<br/><br/>';
                ++$i;
            }
           if($placedispo==0){
           break;
           }

        //    $finsejour=date("Y-m-d + '".$_POST['dureesejour']."'") ;
        //    echo $finsejour.'<br/>';
            

        }


        // CALCUL SOMME TOTAL DU SEJOUR
        $duree=$_POST['dureesejour'];
        $optiontotal= $option1 + $option2 + $option3;
        $totalsejour=($optiontotal*$duree) + $duree*$tarifjour;

      

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

        if(($placedispo>=2 and $_POST['habitat']=='cpgcar') or ($placedispo>=1 and $_POST['habitat']=='tente'))
        {

            $connexion=mysqli_connect("Localhost","root","","camping");
            $requete="INSERT INTO reservationplace (date,emplacement,habitat,dureesejour,borne,disco,yfs,prixtotal,id_utilisateur) VALUES ('".$date."','".$place."','".$habitat."','".$_POST['dureesejour']."','".$_POST['borne']."','".$_POST['disco']."','".$_POST['yfs']."','".$totalsejour."','".$_SESSION['ID']."') ";
            $query=mysqli_query($connexion,$requete);
    
            echo 'reservation validé'.'<br/>'.'<br/>';
            echo 'Votre séjour est d\'une durée de '.$duree.' jours.'.'<br/>';
            echo 'Votre séjour vous coûtera la sommes de '.$totalsejour.'€.'.'<br/>';
            echo '<a href="profil.php">Voir vos réservations</a><br/>';

        }
        else
        {
            echo 'Il ne reste plus de place disponible à cette période et pour ce lieu : '.ucfirst($_POST['emplacement']).'<br/>'.'<br/>'; 
        }

        
        
    }
    else
    {
        echo 'Veuillez saisir les informations obligatoires'.'<br/>';
    }


}


    

    




?>




</html>