<html>



<?php
session_start();

    if($_SESSION['login']="admin"){

        echo '<h1>Bienvenue admninistrateur'.'</h1><br/>';

        $connexion=mysqli_connect("Localhost","root","","camping");
        ?>
        <head>
            <title>Page Admin</title>
            <link rel="stylesheet" href="css/camping.css">
        </head>


        <?php

        if(!isset($_POST['habitat'])){
            $habitat="tente";
        }
        else{
            $habitat=$_POST['habitat'];
        }

        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='pins' and habitat='".$habitat."' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);

        $requete1bis0="SELECT * FROM reservationplace WHERE emplacement='pins'";
        $query1bis0=mysqli_query($connexion,$requete1bis0);
        $resultat1bis0=mysqli_fetch_all($query1bis0);
        
        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='pins'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);


        ?> 
        <h1>Réservation pour les Pins</h1>
        <h2>Nb de réservations total : <?php echo count($resultat1bis0) ?></h2>
        <h2>Sommes total cumulé sur les Pins : <?php echo $resultat0[0]; ?> euros</h2>

        <form action="" method="post">
            <select name="habitat">
                <option value="tente">Tente</option>
                <option value="cpgcar">Camping-car</option>
            </select>
            <input type="submit" value="valider">
        </form>
        <?php

        ?> <section class="sectionadmin"><article><?php
        $j=0;
        while($j<count($resultat)){

              
        $login=ucfirst($resultat[$j][1]);
        $nb_reservation=count($resultat);
        $date=$resultat[$j][4];
        $emplacement=$resultat[$j][5];
        $habitat=ucfirst($resultat[$j][6]);
        $duree=$resultat[$j][7];
        $borne=ucfirst($resultat[$j][8]);
        $disco=ucfirst($resultat[$j][9]);
        $yfs=ucfirst($resultat[$j][10]);
        $prixtotal=number_format($resultat[$j][11],2);


        echo "<table><th>$login</th>
        <tr>
        <td>Date de réservation = $date</td>
        </tr>
        <tr>
        <td>Type d'hébergement = $habitat</td>
        </tr>
        <tr>
        <td>Durée du séjour = $duree jours</td>
        </tr>
        <tr>
        <td>Accès à la borne électrique = $borne</td>
        </tr>
        <tr>
        <td>accès au Disco-Club “Les girelles dansantes” = $disco</td>
        </tr>
        <tr>
        <td>Accès aux activités Yoga, Frisbee et Ski Nautique = $yfs</td>
        </tr>
        <tr>
        <td>Prix total TTC = $prixtotal Euros</td>
        </tr>
        <tr>
        <td><a href=''>ANNULER RESERVATION</a></td>
        </tr></table>"
        ;
        ++$j;
        ?> <?php

        }
        ?></article></section><?php

        if(!isset($_POST['habitat1'])){
            $habitat1="tente";
        }
        else{
            $habitat1=$_POST['habitat1'];
        }

        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='plage' and habitat='".$habitat1."' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);
        $requete1="SELECT * FROM reservationplace WHERE emplacement='plage'";
        $query1=mysqli_query($connexion,$requete1);
        $resultat1=mysqli_fetch_all($query1);
        

        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='plage'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);
      


        ?> 
        <h1>Réservation pour la Plage</h1>
        <h2>Nb de réservations total : <?php echo count($resultat1) ?></h2>
        <h2>Sommes total cumulé sur le plage : <?php echo $resultat0[0]; ?> euros</h2>

        <form action="" method="post">
            <select name="habitat1">
                <option value="tente">Tente</option>
                <option value="cpgcar">Camping-car</option>
            </select>
            <input type="submit" value="valider">
        </form>
        <?php

        ?><section class="sectionadmin"><article><?php
        $j=0;
        while($j<count($resultat)){

              
        $login=ucfirst($resultat[$j][1]);
        $nb_reservation=count($resultat);
        $date=$resultat[$j][4];
        $emplacement=$resultat[$j][5];
        $habitat=ucfirst($resultat[$j][6]);
        $duree=$resultat[$j][7];
        $borne=ucfirst($resultat[$j][8]);
        $disco=ucfirst($resultat[$j][9]);
        $yfs=ucfirst($resultat[$j][10]);
        $prixtotal=number_format($resultat[$j][11],2);

        echo "<table><th>$login</th>
        <tr>
        <td>Date de réservation = $date</td>
        </tr>
        <tr>
        <td>Type d'hébergement = $habitat</td>
        </tr>
        <tr>
        <td>Durée du séjour = $duree jours</td>
        </tr>
        <tr>
        <td>Accès à la borne électrique = $borne</td>
        </tr>
        <tr>
        <td>accès au Disco-Club “Les girelles dansantes” = $disco</td>
        </tr>
        <tr>
        <td>Accès aux activités Yoga, Frisbee et Ski Nautique = $yfs</td>
        </tr>
        <tr>
        <td>Prix total TTC = $prixtotal Euros</td>
        </tr></table>"
        ;
        ++$j;
        }
        ?></article></section><?php
       
        if(!isset($_POST['habitat2'])){
            $habitat2="tente";
        }
        else{
            $habitat2=$_POST['habitat2'];
        }


        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='maquis' and habitat='".$habitat2."' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);
        $requete1bis="SELECT * FROM reservationplace WHERE emplacement='maquis'";
        $query1bis=mysqli_query($connexion,$requete1bis);
        $resultat1bis=mysqli_fetch_all($query1bis);
      
        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='maquis'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);


        ?> 
        <h1>Réservation pour le Maquis</h1>
        <h2>Nb de réservations total : <?php echo count($resultat1bis) ?></h2>
        <h2>Sommes total cumulé sur le maquis : <?php echo $resultat0[0]; ?> euros</h2>

        <form action="" method="post">
            <select name="habitat2">
                <option value="tente">Tente</option>
                <option value="cpgcar">Camping-car</option>
            </select>
            <input type="submit" value="valider">
        </form>
        <?php

        ?> <section class="sectionadmin"><article><?php
        $j=0;
        while($j<count($resultat)){

              
        $login=ucfirst($resultat[$j][1]);
        $nb_reservation=count($resultat);
        $date=$resultat[$j][4];
        $emplacement=$resultat[$j][5];
        $habitat=ucfirst($resultat[$j][6]);
        $duree=$resultat[$j][7];
        $borne=ucfirst($resultat[$j][8]);
        $disco=ucfirst($resultat[$j][9]);
        $yfs=ucfirst($resultat[$j][10]);
        $prixtotal=number_format($resultat[$j][11],2);

        echo "<table><th>$login</th>
        <tr>
        <td>Date de réservation = $date</td>
        </tr>
        <tr>
        <td>Type d'hébergement = $habitat</td>
        </tr>
        <tr>
        <td>Durée du séjour = $duree jours</td>
        </tr>
        <tr>
        <td>Accès à la borne électrique = $borne</td>
        </tr>
        <tr>
        <td>accès au Disco-Club “Les girelles dansantes” = $disco</td>
        </tr>
        <tr>
        <td>Accès aux activités Yoga, Frisbee et Ski Nautique = $yfs</td>
        </tr>
        <tr>
        <td>Prix total TTC = $prixtotal Euros</td>
        </tr></table>"
        ;
        ++$j;
        }
        ?></article></section>
        
        <?php
        
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

        <!-- MODIFICATION VALEUR PRIX -->

        <h1>Modifier les tarifs</h1> 

        <form action="" method="POST">
            <label for="">Tarif borne :</label><input type="text" name="borne" value="<?php echo $tarifborne ?>"><br>
            <label for="">Tarif Disco :</label><input type="text" name="disco" value="<?php echo $tarifdisco ?>"><br>
            <label for="">Tarif Formule YFS :</label><input type="text" name="yfs" value="<?php echo $tarifyfs ?>"><br>
            <label for="">Tarif Journalier location :</label><input type="text" name="jour" value="<?php echo $tarifjour ?>"><br>
            <input type="submit" name="modifier">
        </form>

        <?php
   
   if(isset($_POST['modifier']) and isset($_POST['borne']) and isset($_POST['disco']) and isset($_POST['yfs']) and isset($_POST['jour'])){

        $requete = "UPDATE tarif SET jour='".$_POST['jour']."',borne='".$_POST['borne']."', disco='".$_POST['disco']."', yfs='".$_POST['yfs']."'";
        $query=mysqli_query($connexion,$requete);
        // echo $requete;
    }
   

    }
    else{
        echo 'Cette page vous est inacessible'.'<br/>';
    }


?>



</html>