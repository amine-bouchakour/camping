<html>



<?php

    if($_SESSION['login']="admin"){

        $connexion=mysqli_connect("Localhost","root","","camping");
        ?>
        <head>
            <title>Page Admin</title>
            <link rel="stylesheet" href="css/camping.css">
        </head>


        <?php

        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='pins' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);
        
        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='pins'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);


        ?> 
        <h1>Réservation pour les Pins</h1>
        <h2>Nb de réservations total : <?php echo count($resultat) ?></h2>
        <h2>Sommes total cumulé sur les Pins : <?php echo $resultat0[0]; ?> euros</h2>

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


        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='plage' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);

        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='plage'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);
      


        ?> 
        <h1>Réservation pour la Plage</h1>
        <h2>Nb de réservations total : <?php echo count($resultat) ?></h2>
        <h2>Sommes total cumulé sur le plage : <?php echo $resultat0[0]; ?> euros</h2>
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
       


        $requete="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='maquis' ORDER BY date,login DESC";
        $query=mysqli_query($connexion,$requete);
        $resultat=mysqli_fetch_all($query);
        // var_dump($resultat);
      
        $requete0="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='maquis'";
        $query0=mysqli_query($connexion,$requete0);
        $resultat0=mysqli_fetch_row($query0);


        ?> 
        <h1>Réservation pour le Maquis</h1>
        <h2>Nb de réservations total : <?php echo count($resultat) ?></h2>
        <h2>Sommes total cumulé sur le maquis : <?php echo $resultat0[0]; ?> euros</h2>
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
        ?></article></section><?php
        



        echo 'Bienvenue admninistrateur'.'<br/>';




    }
    else{
        echo 'Cette page vous est inacessible'.'<br/>';
    }


?>

</html>