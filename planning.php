<!DOCTYPE html>

<html>
    <head>
        <title>Planning</title>
        <link rel="stylesheet" type="text/css" href="camping.css">
    </head>
    <body id="bodyPlanning">
        <?php include('header.php') ?>
        <main id="mainPlanning">
            <h1 id="titrePlanning">NOS RESERVATION</h1><br />
            <?php

                if(isset($_SESSION['login']))
                {

                    $connexion=mysqli_connect("Localhost","root","","camping");
                    $requete="SELECT * FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id ORDER BY datedebut DESC";
                    $query=mysqli_query($connexion,$requete);
                    $resultat=mysqli_fetch_all($query);

                    

                    if(!empty($resultat))
                    {
                        $Id=$resultat[0][9];
                        
                    }
                    $nb_reservation=count($resultat);


                    $j=0;
                    foreach($resultat as $ligne)
                    {
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
                    ?>
                        <section id="sectiontablePlanning">

                            <table class='tablePlanning'>
                            <thead>
                                <td>Date d'entrée</td>
                                <td>Date de sortie</td>
                                <td>Lieu Campement</td>
                                <td>Type d'habitat</td>
                                <td>Durée du séjour</td>
                                <td>Option borne electrique</td>
                                <td>Option Acces Discothèque</td>
                                <td>Option Formule YFS</td>
                        <?php
                            if(isset($_SESSION['login']) && $_SESSION['login']=="admin")
                            {
                               echo "<td>Réservations</td>";
                            }
                        ?>
                        
                            </thead>
                            <tr>
                                <td><?php echo $datedebut ?></td>
                                <td><?php echo $datefin ?></td>
                                <td><?php echo $emplacement ?></td>
                                <td><?php echo $habitat ?></td>
                                <td><?php echo $duree." jours" ?></td>
                                <td><?php if($borne=="Oui"){echo '<h3 class="h3">'.$borne.'</h3>';} else echo $borne ?></td>
                                <td><?php if($disco=="Oui"){echo '<h3 class="h3">'.$disco.'</h3>';} else echo $disco ?></td>
                                <td><?php if($yfs=="Oui"){echo '<h3 class="h3">'.$yfs.'</h3>';} else echo $yfs ?></td>
                            <?php
                            if(isset($_SESSION['login']) && $_SESSION['login'] == "admin")
                            {
                                echo "<td><a href='profil.php?id=$ligne[0]'>Supprimer réservations<a></td>";
                            }
                            ?>
                            
                            </tr>
                        </table><br/>
                        </section>
                        
                        <?php
                    }

                }
                else{
                    header('location:connexion.php');
                }


                ?>
                <?php include('footer.php'); ?>
        </main>
    </body>


</html>